<?php

require_once 'app/utils/random/Randomizer.php';
/**
* class that handles the taking of a random Mobile operator values
*/
class MobileOperatorRandomizer extends Randomizer {

	private static $probabilities = array(
		'mtel' 		=> array('min'=>2, 'max'=> 8),
		'telenor' 	=> array('min'=>3, 'max'=> 8),
		'vivacom' 	=> array('min'=>4, 'max'=> 7)
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

	public static function generateProbableValues($value, $min, $max){
		
		if($min < $max) {
			$delta = $max - $min;
			$random_occurrence = rand() % $delta;
		} else {
			$random_occurrence = 0;
		}

		return array_fill(0, $min + $random_occurrence, $value);
	}

}