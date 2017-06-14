<?php
/**
* the main server class 
*/
class Server {
	private $_host;
	private $_root;
	private $_db;
	private static $_server_instance;

	function __construct($host, $root_dir) {
		$this->_host = $host;
		$this->_root = $root_dir;
		self::$_server_instance = $this;
	}

	public function getHost(){
		return $this->_host;
	}

	public function getRoot(){
		return $this->_root;
	}

	public function getDb() {
		return $this->_db;
	}

	public static function getInstance() {
		return self::$_server_instance;
	}

	public function executeRequest(){
		$this->defineGeneralConstants();
		$this->requireServerFiles();

		try {
			$this->initializeDatabase();
			$this->matchAndExecutePath();
		} catch (Exception $e) {
			Util::dump($e->getTraceAsString(), $e->getMessage());

			echo Template::get('error_500');
		}
	}

	public function defineGeneralConstants(){		
		// error_reporting(E_ERROR | E_PARSE);
		// error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
		session_start();

		// server settings
		define('ROOTDIR', sprintf('%s/',$this->getRoot()));
		define('TEMPLATES', sprintf('%sfrontend/templates/', ROOTDIR));
		define('PATH_APP', '/personal-projects/mobile-operator-statistics-app/');
		// database settings
		define('DB_NAME', 'mo_statistics');
		define('DB_USER', 'root');
		define('DB_PASS', '');
		define('DB_HOST', 'localhost');
	}

	public function requireServerFiles(){
		require_once 'app/libs/altoRouter/AltoRouter.php';
		require_once 'app/utils/SqlClient.php';
		require_once 'app/utils/Util.php';
		require_once 'app/utils/ChartUtil.php';
		require_once 'app/utils/Template.php';

		require_once 'app/libs/flourishlib/fLoader.php';
	}

	public function matchPath(){

		$router = new AltoRouter();

		$router->setBasePath(PATH_APP);

		$router->map('GET|POST', '', 'MainController::homePage', 'MainController::homePage');
		$router->map('GET|POST', 'auth/register', 'MainController::registerUser', 'MainController::registerUser');
		$router->map('GET|POST', 'auth/login', 'MainController::userLogin', 'MainController::userLogin');
		$router->map('GET|POST', 'import/personal_usage/[*:month]', 'ImportController::importPersonalUsage', 'ImportController::importPersonalUsage');
		$router->map('GET|POST', 'statistic/[*:frame]', 'StatisticController::statisticFrame', 'StatisticController::statisticFrame');

		$matching = $router->match();

		return $matching;
		
	}

	public function executePath($matched_path = array()){
		if (isset($matched_path) && $matched_path) {
			
			$function = array_key_exists('name', $matched_path) && isset($matched_path['name']) ? $matched_path['name'] : $matched_path['target'];
			$params = $matched_path['params'];

			list($class,$method) = explode("::", $function);
			$controller = sprintf('/app/controllers/%s.php', $class);
			
			require_once  $controller;

			call_user_func_array($function, $params);
		} else {
			echo Template::get('error_404');
		}
	}

	public function matchAndExecutePath(){
		$this->executePath($this->matchPath());
	}

	public function initializeDatabase(){

    	fLoader::best();
		
		$mysql_db = new fDatabase('mysql', DB_NAME, DB_USER, DB_PASS, DB_HOST);

		$mysql_db->connect();

		$this->_db = $mysql_db;

		fORMDatabase::attach($mysql_db);

	}

	public static function requireModel($table){
		switch ($table) {
			case 'personal_usage':
				require_once 'app/models/PersonalUsage.php';
				break;
				
			case 'user':
				require_once 'app/models/User.php';
				break;
			
			default:
				# code...
				break;
		}
	}

}