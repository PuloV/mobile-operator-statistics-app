<?php 
/**
* controller that handles statistic pages like month/year/quater
*/
class StatisticController{
	
	public static function statisticFrame($frame='month',$start_time = NULL){
		$data = array();
		
		switch ($frame) {
			case 'monthly':
				$data['frame_title'] = 'Monthly';
				break;

			case 'quaterly':
				$data['frame_title'] = 'Quaterly';
				break;
				
			case 'yearly':
				$data['frame_title'] = 'Yearly';
				break;
			
			default:
				# code...
				$data['frame_title'] = $frame;
				break;
		}

		$statistics = self::generateStatisticsForFrame($frame);
		
		$data['mobile_operator_chart'] 	= ChartUtil::getChart('mobile_operator_chart', $statistics['operator_grouped']);
		$data['age_group_chart'] 		= ChartUtil::getChart('age_group_chart', $statistics['age_grouped']);
		$data['gender_group_chart'] 	= ChartUtil::getChart('gender_group_chart', $statistics['gender_grouped']);


		echo Template::get('time_period_stats', $data);
	}

	public static function generateStatisticsForFrame($frame='monthly')	{
		$data = array();
		

		switch ($frame) {
			case 'monthly':
				$from_date 	= new DateTime('today -1 month');
				$to_date 	= new DateTime('today');
				break;

			case 'quaterly':
				$from_date 	= new DateTime('today -3 month');
				$to_date 	= new DateTime('today');
				break;
				
			case 'yearly':
				$from_date 	= new DateTime('today -1 year');
				$to_date 	= new DateTime('today');				
				break;
			
			default:
				$from_date 	= new DateTime('1990');
				$to_date 	= new DateTime('today');
				break;
		}


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
		
		$operator_grouped = SqlClient::getRecords(
			'SELECT 
			personal_usage.mobile_operator AS mobile_operator , 
			COUNT(personal_usage.id) AS people
			FROM personal_usage			
			WHERE personal_usage.respondent_date BETWEEN %s AND %s
			GROUP BY personal_usage.mobile_operator',
			$from_date->format("Y-m-d 00:00:00"),
			$to_date->format("Y-m-d 23:59:59")
		);
		
		$age_grouped = SqlClient::getRecords(
			'SELECT 
			CASE  
				WHEN personal_usage.age BETWEEN 16 AND 20 THEN \'16-20\' 
				WHEN personal_usage.age BETWEEN 20 AND 30 THEN \'20-30\' 
				WHEN personal_usage.age BETWEEN 30 AND 40 THEN \'30-40\' 
				WHEN personal_usage.age BETWEEN 40 AND 65 THEN \'40-65\' 
				WHEN personal_usage.age > 65 THEN \'65+\' 
				ELSE \'unknown\'
				END	AS `age_group`  , 
			COUNT(personal_usage.id) AS people
			FROM personal_usage			
			WHERE personal_usage.respondent_date BETWEEN %s AND %s
			GROUP BY `age_group`',
			$from_date->format("Y-m-d 00:00:00"),
			$to_date->format("Y-m-d 23:59:59")
		);

		$data['gender_grouped'] 		= $gender_grouped;
		$data['operator_grouped'] 		= $operator_grouped;
		$data['age_grouped'] 			= $age_grouped;

		return $data;
	}
}