<?php 
/**
* controller that handles main pages like login/register/index/404
*/
class ImportController
{
	
	public static function homePage(){
		Util::dump(Server::getInstance()->getDb(), TITLE);
		
	}
}