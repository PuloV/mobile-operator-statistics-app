<?php

class SqlClient {


	public static function getDB()	{
		$server = Server::getInstance();
		$db = $server->getDb();
		return $db;
	}

	public static function buildQuery($params = array()){
 		
		$sql = array_shift($params);

		if (count($params) > 0) {
			$query = self::getDb()->escape($sql,$params);
		} else {
			$query = $sql;
		}
		// Util::dump($query, 'query');

		return $query;
	}

	public static function getRecords() {
 		$params = func_get_args();

		$tmp = call_user_func_array('SqlClient::execute', $params);

		//put shit in arrays
		if(!empty($tmp)) {

			foreach($tmp as $var) {

				$result[] = $var;

			}

		}

		return $result;
	}


	public static function execute() {
		$params = func_get_args();

 		$db = self::getDb();
 		
 		$query = self::buildQuery($params);
		//
		$tmp = $db->query($query);
		
		return $tmp;


	}

}
?>
