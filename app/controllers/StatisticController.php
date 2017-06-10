<?php 
/**
* controller that handles statistic pages like month/year/quater
*/
class StatisticController{
	
	public static function statisticFrame($frame='month',$start_time = NULL){
		$data = array();
		
		$data['mobile_operator_chart'] = ChartUtil::getChart('mobile_operator_chart', $date_grouped);

		echo Template::get('time_period_stats', $data);
	}
}