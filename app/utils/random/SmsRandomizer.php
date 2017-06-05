<?php

require_once 'app/utils/random/Randomizer.php';
/**
* class that handles the taking of a random SMS values
*/
class SmsRandomizer extends Randomizer {

	private static $probabilities = array(
		'5' => array('min'=>2, 'max'=> 4),
		'10' => array('min'=>3, 'max'=> 8),
		'30' => array('min'=>3, 'max'=> 8),
		'50' => array('min'=>3, 'max'=> 8),
		'70' => array('min'=>3, 'max'=> 7),
		'90' => array('min'=>2, 'max'=> 7),
		'100' => array('min'=>2, 'max'=> 4),
		'200' => array('min'=>1, 'max'=> 4),
		'300' => array('min'=>1, 'max'=> 3),
		'400' => array('min'=>1, 'max'=> 3),
	);
	
	function __construct(){

		parent::__construct(self::generateProbableData(self::$probabilities), false);
		$shuffle_times = (rand() % 10) + 1;
		$this->shuffle($shuffle_times);
	}

	public static function generateProbableData($probabilities = array()){
		$probable = array();
		foreach ($probabilities as $value => $occurs) {
			$probable = array_merge($probable, self::generateProbableValues($value,$occurs['min'], $occurs['max']));
		}
		return $probable;
	}

	public static function generateProbableValues($max_value, $min, $max){
		$min_value = intval(sqrt($max_value));

		if($min < $max) {
			$delta = $max - $min;
			$random_occurrence = rand() % $delta;
		} else {
			$random_occurrence = 0;
		}
		
		$data = array();
		
		for ($i=0; $i <= $min + $random_occurrence ; $i++) { 
			$data[] = rand($min_value,$max_value);
		}

		return $data;
	}

}