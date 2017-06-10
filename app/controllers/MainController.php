<?php 
/**
* controller that handles main pages like login/register/index/404
*/
class MainController{
	
	public static function homePage(){

		echo Template::get('main_stats');
		
	}
}