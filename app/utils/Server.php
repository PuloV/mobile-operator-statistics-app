<?php
/**
* the main server class 
*/
class Server {
	private $_host;
	private $_root;

	function __construct($host, $root_dir) {
		$this->_host = $host;
		$this->_root = $root_dir;
	}

	public function getHost(){
		return $this->_host;
	}

	public function getRoot(){
		return $this->_root;
	}

	public function executeRequest(){
		$this->defineGeneralConstants();
		$this->requireServerFiles();
		$this->matchAndExecutePath();
	}

	public function defineGeneralConstants(){		
		error_reporting(E_ERROR);
		define('ROOTDIR', $this->getRoot());
	}

	public function requireServerFiles(){
		require_once 'app/libs/altoRouter/AltoRouter.php';
		require_once 'app/utils/Util.php';
	}

	public function matchPath(){

		$router = new AltoRouter();

		$router->setBasePath('/personal-projects/mobile-operator-statistics-app/');

		$router->map('GET|POST', '', 'MainController::homePage', 'MainController::homePage');

		$matching = $router->match();

		return $matching;
		
	}

	public function executePath($matched_path = array()){
		if (isset($matched_path)) {
			
			$function = array_key_exists('name', $matched_path) && isset($matched_path['name']) ? $matched_path['name'] : $matched_path['target'];
			$params = $matched_path['params'];

			list($class,$method) = explode("::", $function);
			$controller = sprintf('/app/controllers/%s.php', $class);
			
			require_once  $controller;

			call_user_func_array($function, $params);
		} else {
			echo "<h1> Not Found </h1>";
		}
	}

	public function matchAndExecutePath(){
		$this->executePath($this->matchPath());
	}
}