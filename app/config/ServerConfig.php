<?php 
/**
* 
*/
class ServerConfig {
	
	private $_server;

	private static $MUST_HAVE_CONSTANTS = array(
		"ROOTDIR"
	);

	public function __construct($server_host){
		$this->_server = $server_host;
	}

	/**
	 * [getLocalhostDBConnectionCredentials description]
	 * @author @yordan on 2017-06-04
	 * @return [type] [description]
	 */
	public function getLocalhostDBConnectionCredentials(){
		return array(
			"db_name" =>"mo_statistics",
			"db_user" =>"root",
			"db_pass" =>"",
			"db_host" =>"localhost"
		);
	}

	/**
	 * [getDBConnectionCredentials description]
	 * @author @yordan on 2017-06-04
	 * @return [type] [description]
	 */
	public function getDBConnectionCredentials(){
		$db_credentials = array();

		switch ($this->_server) {
			case 'localhost':
				$db_credentials = $this->getLocalhostDBConnectionCredentials();
				break;

			default:
				break;
		}

		return $db_credentials;
	}

	public function getDBConnectionName(){
		return $this->getDBConnectionCredentials()["db_name"];
	}

	public function getDBConnectionUser(){
		return $this->getDBConnectionCredentials()["db_user"];
	}

	public function getDBConnectionPassword(){
		return $this->getDBConnectionCredentials()["db_pass"];
	}

	public function getDBConnectionHost(){
		return $this->getDBConnectionCredentials()["db_host"];
	}


}