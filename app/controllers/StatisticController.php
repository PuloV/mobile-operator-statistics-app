<?php 
/**
* controller that handles statistic pages like month/year/quater
*/
class StatisticController{
	
	public static function statisticFrame($frame='month'){
		$data = array();

		// get data from request 
		$start_date   	= fRequest::get('start_date', 'string', NULL); 
		
		switch ($frame) {
			case 'weekly':
				$data['frame_title'] = 'Weekly';
				break;	

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

		$statistics = self::generateStatisticsForFrame($frame, $start_date);

		$data['from_date_value'] 	= $statistics['from_date_value'];
		$data['from_date'] 			= $statistics['from_date'];
		$data['to_date'] 			= $statistics['to_date'];
		
		$data['mobile_operator_chart'] 			= ChartUtil::getChart('mobile_operator_chart', $statistics['operator_grouped']);

		$data['age_group_chart'] 				= ChartUtil::getChart('age_group_chart', $statistics['age_grouped']);
		$data['gender_group_chart'] 			= ChartUtil::getChart('gender_group_chart', $statistics['gender_grouped']);
		$data['minutes_chart_graph'] 			= ChartUtil::getChart('minutes_chart_graph', $statistics['age_grouped']);
		$data['megabytes_chart_graph'] 			= ChartUtil::getChart('megabytes_chart_graph', $statistics['age_grouped']);
		$data['sms_chart_graph'] 				= ChartUtil::getChart('sms_chart_graph', $statistics['age_grouped']);
		$data['tax_chart_graph'] 				= ChartUtil::getChart('tax_chart_graph', $statistics['age_grouped']);

		$data['operator_grouped_chart'] 		= ChartUtil::getChart('operator_age_grouped_chart', $statistics['operator_age_grouped']);
		$data['operator_tax_grouped_chart'] 	= ChartUtil::getChart('operator_tax_grouped_chart', $statistics['operator_age_grouped']);
		$data['operator_sms_grouped_chart'] 	= ChartUtil::getChart('operator_sms_grouped_chart', $statistics['operator_age_grouped']);
		$data['operator_mb_grouped_chart'] 		= ChartUtil::getChart('operator_mb_grouped_chart', $statistics['operator_age_grouped']);
		$data['operator_min_grouped_chart'] 	= ChartUtil::getChart('operator_min_grouped_chart', $statistics['operator_age_grouped']);

		$average_age 			= 0.00;
		$average_tax_amount 	= 0.00;
		$average_minutes 		= 0.00;
		$average_megabytes		= 0.00;
		$average_sms_count 		= 0.00;

		foreach ($statistics['gender_grouped'] as $key => $group) {

			$average_age 		+= $group['average_age'];
			$average_tax_amount += $group['average_tax_amount'];
			$average_minutes 	+= $group['average_minutes'];
			$average_megabytes 	+= $group['average_megabytes'];
			$average_sms_count 	+= $group['average_sms_count'];			
		}

		$data['average_age'] 		= number_format($average_age / count($statistics['gender_grouped']), 2, ',', ' ');
		$data['average_tax_amount'] = number_format($average_tax_amount / count($statistics['gender_grouped']), 2, ',', ' ');
		$data['average_minutes'] 	= number_format($average_minutes / count($statistics['gender_grouped']), 2, ',', ' ');
		$data['average_megabytes'] 	= number_format($average_megabytes / count($statistics['gender_grouped']), 2, ',', ' ');
		$data['average_sms_count'] 	= number_format($average_sms_count / count($statistics['gender_grouped']), 2, ',', ' ');		

		echo Template::get('time_period_stats', $data);
	}

	public static function generateStatisticsForFrame($frame='monthly', $start_date_value = NULL)	{
		$data = array();
		
		if (isset($start_date_value) && $start_date_value != '') {

			$from_date = new DateTime($start_date_value);

			switch ($frame) {
				case 'weekly':
					$to_date 	= clone $from_date;
					$to_date->modify('+7 days');
					break;

				case 'monthly':
					$to_date 	= clone $from_date;
					$to_date->modify('+1 month');
					break;

				case 'quaterly':
					$to_date 	= clone $from_date;
					$to_date->modify('+3 month');
					break;
					
				case 'yearly':
					$to_date 	= clone $from_date;
					$to_date->modify('+1 year');				
					break;
				
				default:
					$to_date 	= new DateTime('today');
					break;
			}

		} else {
			
			switch ($frame) {
				case 'weekly':
					$from_date 	= new DateTime('today -7 days');
					$to_date 	= new DateTime('today');
					break;
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
		}

		$data['from_date_value'] 	= $from_date->format("Y-m-d");
		$data['from_date'] 			= $from_date->format("d.m.Y");
		$data['to_date'] 			= $to_date->format("d.m.Y");


		$gender_grouped = SqlClient::getRecords(
			'SELECT 
			personal_usage.gender AS gender , 
			COUNT(personal_usage.id) AS people,
			AVG(personal_usage.age) AS `average_age` ,
			AVG(personal_usage.tax_amount) AS `average_tax_amount` ,
			AVG(personal_usage.minutes) AS `average_minutes` ,
			AVG(personal_usage.megabytes) AS `average_megabytes`,
			AVG(personal_usage.sms_count) AS `average_sms_count` 
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
			COUNT(personal_usage.id) AS people,
			AVG(personal_usage.megabytes) AS `average_mb`,
			AVG(personal_usage.sms_count) AS `average_sms`,
			AVG(personal_usage.minutes) AS `average_mins`,
			AVG(personal_usage.tax_amount) AS `average_tax`
			FROM personal_usage			
			WHERE personal_usage.respondent_date BETWEEN %s AND %s
			GROUP BY `age_group`
			ORDER BY `age_group`',
			$from_date->format("Y-m-d 00:00:00"),
			$to_date->format("Y-m-d 23:59:59")
		);		

		$operator_age_grouped = SqlClient::getRecords(
			'SELECT 
			CASE  
				WHEN personal_usage.age BETWEEN 16 AND 20 THEN \'16-20\' 
				WHEN personal_usage.age BETWEEN 20 AND 30 THEN \'20-30\' 
				WHEN personal_usage.age BETWEEN 30 AND 40 THEN \'30-40\' 
				WHEN personal_usage.age BETWEEN 40 AND 65 THEN \'40-65\' 
				WHEN personal_usage.age > 65 THEN \'65+\' 
				ELSE \'unknown\'
				END	AS `age_group`  , 
			COUNT(personal_usage.id) AS people,
			personal_usage.mobile_operator AS `mobile_operator` , 
			SUM(personal_usage.megabytes) AS `total_mb`,
			SUM(personal_usage.sms_count) AS `total_sms`,
			SUM(personal_usage.minutes) AS `total_mins`,
			SUM(personal_usage.tax_amount) AS `total_tax`
			FROM personal_usage			
			WHERE personal_usage.respondent_date BETWEEN %s AND %s
			GROUP BY `age_group`, personal_usage.mobile_operator
			ORDER BY `age_group`',
			$from_date->format("Y-m-d 00:00:00"),
			$to_date->format("Y-m-d 23:59:59")
		);

		$data['gender_grouped'] 		= $gender_grouped;
		$data['operator_grouped'] 		= $operator_grouped;
		$data['age_grouped'] 			= $age_grouped;
		$data['operator_age_grouped'] 	= $operator_age_grouped;

		return $data;
	}

	public static function displayStatisticsData(){
		fAuthorization::requireLoggedIn();

		$date   	= fRequest::get('for_date', 'string', date("Y-m-d")); 

		$data 				= array();
		$data['for_date'] 	= $date;

		$statistics_data = SqlClient::getRecords( 
			"SELECT personal_usage.*
			FROM personal_usage
			WHERE personal_usage.respondent_date BETWEEN %s AND %s",
			$date. ' 00:00',
			$date. ' 23:59'
		);

		$data['statistics_entries'] = array_reduce(
			$statistics_data, 
			function($carry, $statistics_entry){
				$stats_data = array();
				
				$stats_data['id'] 	= $statistics_entry['id'];
				$stats_data['name'] 	= $statistics_entry['name'];
				$stats_data['gender']   = $statistics_entry['gender'] == 'M' ? 'Male' : 'Female'; 
				$stats_data['age'] 		= $statistics_entry['age'];
					
				switch ($statistics_entry['mobile_operator']) {
					case 'vivacom':
						$stats_data['operator'] = 'Vivacom';
						break;
					case 'telenor':
						$stats_data['operator'] = 'Telenor';
						break;
					case 'mtel':
						$stats_data['operator'] = 'M-tel';
						break;
					default:
						$stats_data['operator'] = 'Unknown';
						break;
				}
				
				$stats_data['date'] = $statistics_entry['respondent_date'];

				return $carry.Template::get('statistics_entry',$stats_data);
			}
		);

		echo Template::get('statistics_data', $data);

	}

	public static function deleteStatisticEntry(){
		fAuthorization::requireLoggedIn();
		
		Server::requireModel('personal_usage'); 

		// get data from request 
		$id   	= fRequest::get('id', 'integer', NULL);
		$result = array('success' => 1);
		try {
		 	$entry = new PersonalUsage($id);
		 	$entry->delete();
		} catch (Exception $e) {
		 	$result['success'] = 0;
		 	$result['message'] = $e->getMessage();
		}

		echo json_encode($result); 
	}	

	public static function getStatisticEntry(){
		fAuthorization::requireLoggedIn();
		
		Server::requireModel('personal_usage'); 

		// get data from request 
		$id   	= fRequest::get('id', 'integer', NULL);
		$result = array('success' => 1);
		try {
		 	$entry = new PersonalUsage($id);
		 	
		 	$entry_data = array();
		 	$entry_data['id'] 				= $entry->getId();
		 	$entry_data['name'] 			= $entry->getName();
		 	$entry_data['gender'] 			= $entry->getGender();
		 	$entry_data['age'] 				= $entry->getAge();
		 	$entry_data['operator'] 		= $entry->getMobileOperator();
		 	$entry_data['tax'] 				= $entry->getTaxAmount();
		 	$entry_data['minutes'] 			= $entry->getMinutes();
		 	$entry_data['sms'] 				= $entry->getSmsCount();
		 	$entry_data['megabytes'] 		= $entry->getMegabytes();
		 	$entry_data['respondent_date'] 	= $entry->getRespondentDate()->format('Y-m-d');

		 	$result['entry_data'] = $entry_data;

		} catch (Exception $e) {
		 	$result['success'] = 0;
		 	$result['message'] = $e->getMessage();
		}

		echo json_encode($result); 
	}

	public function addEditStatisticEntry(){

		fAuthorization::requireLoggedIn();
		
		Server::requireModel('personal_usage'); 

		// get data from request 
		$id   				= fRequest::get('id', 'integer', NULL);
		$name   			= fRequest::get('name', 'string', NULL);
		$gender   			= fRequest::get('gender', 'string', NULL);
		$age				= fRequest::get('age', 'integer', NULL);
		$mobile_operator   	= fRequest::get('mobile_operator', 'string', NULL);
		$respondent_date   	= fRequest::get('respondent_date', 'string', NULL);
		$minutes			= fRequest::get('minutes', 'integer', NULL);
		$megabytes			= fRequest::get('megabytes', 'integer', NULL);
		$sms				= fRequest::get('sms', 'integer', NULL);
		$tax				= fRequest::get('tax', 'float', NULL);

		$result = array('success' => 1);

		try {
			$entry = new PersonalUsage($id);
		} catch (Exception $e) {
			$entry = new PersonalUsage();
		}

		$entry->setName($name);
		$entry->setGender($gender);
		$entry->setAge($age);
		$entry->setMobileOperator($mobile_operator);
		$entry->setMinutes($minutes);
		$entry->setMegabytes($megabytes);
		$entry->setSmsCount($sms);
		$entry->setTaxAmount($tax);

		try {
			$entry->setRespondentDate(new fTimestamp($respondent_date));
			$entry->store();
		} catch (Exception $e) {
			$result['success'] = 0;
		 	$result['message'] = $e->getMessage();
		 	$result['message_html'] = Util::createMessage(
				'error',
				$e->getMessage()
			);
		}

		echo json_encode($result); 


	}
}