<?php

require_once 'app/utils/random/Randomizer.php';
/**
* class that handles the taking of a random minutes values
*/
class MinRandomizer extends Randomizer {

	private static $probabilities = array(
		'50' => array('min'=>2, 'max'=> 4),
		'100' => array('min'=>3, 'max'=> 8),
		'300' => array('min'=>3, 'max'=> 8),
		'500' => array('min'=>3, 'max'=> 8),
		'750' => array('min'=>3, 'max'=> 7),
		'900' => array('min'=>2, 'max'=> 7),
		'1000' => array('min'=>2, 'max'=> 4),
		'2000' => array('min'=>1, 'max'=> 4),
		'3000' => array('min'=>1, 'max'=> 3),
		'4000' => array('min'=>1, 'max'=> 3),
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