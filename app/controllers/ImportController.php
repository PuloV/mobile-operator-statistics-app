<?php 
/**
* controller that handles main pages like login/register/index/404
*/
class ImportController
{
	
	public static function importPersonalUsage($month = NULL){
		$date = DateTime::createFromFormat('Y-m',$month);

		require_once 'app/utils/random/AgeRandomizer.php';
		require_once 'app/utils/random/TaxRandomizer.php';
		require_once 'app/utils/random/MinRandomizer.php';
		require_once 'app/utils/random/MbRandomizer.php';
		require_once 'app/utils/random/SmsRandomizer.php';

		$ages 		= new AgeRandomizer();
		$taxes 		= new TaxRandomizer();
		$mins 		= new MinRandomizer();
		$megabytes 	= new MbRandomizer();
		$sms 		= new SmsRandomizer();

		Util::dump($megabytes, megabytes);

		
	}
}