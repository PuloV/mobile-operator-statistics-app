<?php 
/**
* controller that handles main pages like login/register/index/404
*/
class MainController{
	
	public static function homePage(){
		
		$from_date 	= new DateTime('today -1 month');
		$from_date 	= new DateTime('1990');
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
}