<?php 
/**
* controller that handles main pages like login/register/index/404
*/
class MainController{
	
	public static function homePage(){
		
		$from_date 	= new DateTime('today -1 month');
		// $from_date 	= new DateTime('1990');
		$to_date 	= new DateTime('today');

		$gender_grouped = SqlClient::getRecords(
			'SELECT 
			personal_usage.gender AS gender , 
			COUNT(personal_usage.id) AS people
			FROM personal_usage			
			WHERE personal_usage.respondent_date BETWEEN %s AND %s
			GROUP BY personal_usage.gender',
			$from_date->format("Y-m-d 00:00:00"),
			$to_date->format("Y-m-d 23:59:59")
		);
		// Util::dump($gender_grouped, gender_grouped);
		
		// fCore::enableDebugging(1);
		$date_grouped = SqlClient::getRecords(
			'SELECT 
			CONCAT(YEAR(personal_usage.respondent_date), \'-\', MONTH(personal_usage.respondent_date), \'-\', DAY(personal_usage.respondent_date)) AS month,
			COUNT(personal_usage.id) AS people
			FROM personal_usage
			WHERE personal_usage.respondent_date BETWEEN %s AND %s
			GROUP BY YEAR(personal_usage.respondent_date), MONTH(personal_usage.respondent_date), DAY(personal_usage.respondent_date)',
			$from_date->format("Y-m-d 00:00:00"),
			$to_date->format("Y-m-d 23:59:59")
		);


		$data = array();
		$data['respondents_date_grouped'] 	= ChartUtil::getChart('month_respondend_area', $date_grouped);
		$data['respondents_gender_grouped'] = ChartUtil::getChart('month_respondend_pie', $gender_grouped);
		echo Template::get('main_stats', $data);
		
	}

	public static function userLogin()	{
		$data = array(
			'email' => '',
			'password' => '',
			'remember_checked' => '',
			'message' => ''
		);

		if (fRequest::isPost()) {
			Server::requireModel('user');

			$password   			= fRequest::get('password', 'string', NULL); 
			$email   				= fRequest::get('email', 'string', NULL); 
			$remember   			= fRequest::get('remember', 'integer', 0); 
			try {
					

				if (empty($email)) {
					$data['message'] = Util::createMessage(
						'warning',
						'Please enter your email'
					);
					throw new Exception("Error Email not set", 1);					
				}				

				if (empty($password)) {
					$data['message'] = Util::createMessage(
						'warning',
						'Please enter your password'
					);
					throw new Exception("Error password not set", 1);	
				}

				try {
					$user = new User(array('email'=> $email));
					$hashed_password = User::createPasswordHash($password, $user->getSalt());

					if (fCryptography::checkPasswordHash($hashed_password, $user->getPassword())) {
						throw new Exception("Error password not mathcing", 1);
					}
					
					fAuthorization::setUserToken($email);

					fURL::redirect(PATH_APP);
					
				} catch (Exception $e) {
					throw new Exception('Wrong user or password', 1);
				}

				
			} catch (Exception $e) {

				$data['email'] 	  = $email;
				$data['password'] = $password;
				
				$data['remember_checked'] 				= $remember ? 'checked' : '';

				if(empty($data['message'])){
					$data['message'] = Util::createMessage(
						'error',
						$e->getMessage()
					);
				}
			}

		}
		echo Template::get('login', $data);
	}	

	public static function registerUser()	{

		$data = array(
			'username' => '',
			'email' => '',
			'password' => '',
			'password_repeated' => '',
			'agree_checked' => '',
			'message' => ''
		);

		if (fRequest::isPost()) {
			Server::requireModel('user');

			$username   			= fRequest::get('username', 'string', NULL); 
			$email   				= fRequest::get('email', 'string', NULL); 
			$password   			= fRequest::get('password', 'string', NULL); 
			$password_repeated   	= fRequest::get('password_repeated', 'string', NULL); 
			$agree   				= fRequest::get('agree', 'integer', 0); 
			try {
				if (!$agree) {
					$data['message'] = Util::createMessage(
						'warning',
						'You must agree with the terms and policy in order to create account'
					);
					throw new Exception("Error terms and policy not checked", 1);	
				}				

				if (empty($email)) {
					$data['message'] = Util::createMessage(
						'warning',
						'You cannot register account without email'
					);
					throw new Exception("Error email not set", 1);
				}				

				if (empty($username)) {
					$data['message'] = Util::createMessage(
						'warning',
						'You cannot register account without username'
					);
					throw new Exception("Error username not set", 1);
				}

				if ($password != $password_repeated) {
					$data['message'] = Util::createMessage(
						'warning',
						'The repeated password doesnt match the password'
					);
					throw new Exception("Error passwords dont match", 1);
				}

				User::createUser(
					$username,
					$email,
					$password
				);
				$data['message'] = Util::createMessage(
					'success',
					'Congrats! You\'ve created you account successfully. Please proceed to login !'
				);
				
			} catch (Exception $e) {

				$data['username'] = $username;
				$data['email'] 	  = $email;
				$data['password'] = $password;
				$data['password_repeated'] = $password_repeated;
				$data['agree_checked'] 				= $agree ? 'checked' : '';

				if(empty($data['message'])){
					$data['message'] = Util::createMessage(
						'error',
						$e->getMessage()
					);
				}
			}

		}
		echo Template::get('register', $data);
	}

	public static function userLogout()	{
		fSession::destroy();
		fAuthorization::destroyUserInfo();

		fURL::redirect(PATH_APP);
	}

	public static function displayUsers(){
		fAuthorization::requireLoggedIn();


		$data 				= array();

		$users = SqlClient::getRecords( 
			"SELECT users.*
			FROM users"
		);

		$data['users_entries'] = array_reduce(
			$users, 
			function($carry, $user_entry){
				$user_data = array();
				
				$user_data['id'] 				= $user_entry['id'];
				$user_data['user_name']			= $user_entry['user_name'];
				$user_data['email'] 			= $user_entry['email'];
				$user_data['selected_user'] 	= $user_entry['role'] == 'user' ? 'selected' : '';
				$user_data['selected_admin'] 	= $user_entry['role'] == 'admin' ? 'selected' : '';				

				return $carry.Template::get('user_entry',$user_data);
			}
		);

		echo Template::get('users', $data);

	}

	public function deleteUser(){
		fAuthorization::requireLoggedIn();
		
		Server::requireModel('user'); 

		// get data from request 
		$id   	= fRequest::get('id', 'integer', NULL);
		$result = array('success' => 1);
		try {
			if ($id == Server::getPerson()->getId()) {
				throw new Exception("You cannot delete your account !", 1);
			}

		 	$entry = new User($id);
		 	$entry->delete();
		} catch (Exception $e) {
		 	$result['success'] = 0;
		 	$result['message'] = $e->getMessage();
		 	$result['message_html'] = Util::createMessage(
				'error',
				$e->getMessage()
			);
		}

		echo json_encode($result); 
	}	

	public function editUser(){
		fAuthorization::requireLoggedIn();
		
		Server::requireModel('user'); 

		// get data from request 
		$id   	= fRequest::get('id', 'integer', NULL);
		$role   = fRequest::get('role', 'string', NULL);
		$result = array('success' => 1);
		try {

		 	$entry = new User($id);
		 	$entry->setRole($role);
		 	$entry->store();

		} catch (Exception $e) {
		 	$result['success'] = 0;
		 	$result['message'] = $e->getMessage();
		 	$result['message_html'] = Util::createMessage(
				'error',
				$e->getMessage()
			);
		}

		echo json_encode($result); 
	}
}