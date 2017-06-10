<?php 
/**
* controller that handles main pages like login/register/index/404
*/
class ImportController
{
	
	public static function importPersonalUsage($month = NULL){
		$month_timestamp = new fTimestamp($start_of_month."-01");
		if ($month_timestamp > time()) {
			die("future");
		}
		// $_SESSION = array();
		// die();
		$start_of_month = DateTime::createFromFormat('Y-m',$month);
		$start_of_month->modify('first day of this month');

		$end_of_month = clone $start_of_month;
		$end_of_month->modify('last day of this month');
		
		$current_date = clone $start_of_month;
		
		$dates = array();
		while ($current_date <= $end_of_month ) {
			$dates[] = $current_date->format('Y-m-d H:i:s');
			$current_date->modify("+1 day");
		}


		require_once 'app/utils/random/AgeRandomizer.php';
		require_once 'app/utils/random/TaxRandomizer.php';
		require_once 'app/utils/random/MinRandomizer.php';
		require_once 'app/utils/random/MbRandomizer.php';
		require_once 'app/utils/random/SmsRandomizer.php';
		require_once 'app/utils/random/GenderRandomizer.php';
		require_once 'app/utils/random/MobileOperatorRandomizer.php';

		Server::requireModel('personal_usage');

		$ages 				= new AgeRandomizer();
		$taxes 				= new TaxRandomizer();
		$mins 				= new MinRandomizer();
		$megabytes 			= new MbRandomizer();
		$texts 				= new SmsRandomizer();
		$genders 			= new GenderRandomizer();
		$mobile_operators 	= new MobileOperatorRandomizer();

		$month_key = $start_of_month->format('Y-m');
		if (!array_key_exists($month_key, $_SESSION)) {
			$requests_count = rand(40,100);
			$current_count  = 0;
			$_SESSION[$month_key]['requests_count'] = $requests_count;
			$_SESSION[$month_key]['current_count']  = $current_count;
		} else {
			$requests_count = $_SESSION[$month_key]['requests_count'];
			$current_count  = $_SESSION[$month_key]['current_count'];
			$_SESSION[$month_key]['current_count']  = $current_count + 1;
		}
		// die(1);
		for ($i=0; $i < 50; $i++) { 

			$name 				= sprintf("Анонимен %d", 50 * $current_count + $i);
			$age 				= $ages->getValue();
			$tax 				= $taxes->getValue();
			$minutes 			= $mins->getValue();
			$megabyte 			= $megabytes->getValue();
			$sms 				= $texts->getValue();
			$gender 			= $genders->getValue();
			$mobile_operator 	= $mobile_operators->getValue();

			shuffle($dates);
			$date 		= new fTimestamp($dates[0]);

			try {				
				$personal_usage = new PersonalUsage();
				$personal_usage->setName($name);
				$personal_usage->setGender($gender);
				$personal_usage->setAge($age);
				$personal_usage->setMobileOperator($mobile_operator);
				$personal_usage->setTaxAmount($tax);
				$personal_usage->setMinutes($minutes);
				$personal_usage->setSmsCount($sms);
				$personal_usage->setMegabytes($megabyte);
				$personal_usage->setRespondentDate($date);
				$personal_usage->store();
			} catch (Exception $e) {
				Util::dump($e->getMessage(), ERRPR);				
			}
		}
		// Util::dump($_SESSION, TITLE);

		echo sprintf("<h3>Requsets %d / %d for month %s. </h3>", $current_count, $requests_count, $month_key);
		// die();
		
		if ($current_count + 1 < $requests_count) {
			$location = sprintf(
				'http://localhost:8080/personal-projects/mobile-operator-statistics-app/import/personal_usage/%s',
				$start_of_month->format('Y-m')
			);
		} else {
			$location = sprintf(
				'http://localhost:8080/personal-projects/mobile-operator-statistics-app/import/personal_usage/%s',
				$start_of_month->modify('+1 month')->format('Y-m')
			);
		}

		echo sprintf('<script> setTimeout(function() {window.location.href = "%s"}, 1000);  </script>', $location);

	}
}