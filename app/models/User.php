<?php 


/**
* ORM model that handels the personal_usage table
*/
class User extends fActiveRecord {

	public static function createUser($username,$email,$password){
		$salt = self::generateSalt();

		$user = new User();
		$user->setUserName($username);
		$user->setEmail($email);
		$user->setSalt($salt);
		$user->setPassword(self::createPasswordHash($password,$salt));
		$user->store();

	}

	public static function generateSalt(){
		return fCryptography::randomString(10);
	}	

	public static function createPasswordHash($password,$salt){

		$pass=sprintf("%s_%s_%s",
			'mous2017',
			$password,
			$salt
		);

		return fCryptography::hashPassword($pass);
	}

	public function isAdmin(){
		return $this->getRole() == 'admin';
	}
}

if (!fORM::isClassMappedToTable('User')) fORM::mapClassToTable('User', 'users');
	            