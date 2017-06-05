<?php

require_once 'app/utils/random/Randomizer.php';
/**
* class that handles the taking of a random tax values
*/
class TaxRandomizer extends Randomizer {

	private static $probabilities = array(
		'9.90' => array('min'=>2, 'max'=> 4),
		'14.90' => array('min'=>3, 'max'=> 8),
		'15.90' => array('min'=>3, 'max'=> 8),
		'16.90' => array('min'=>3, 'max'=> 8),
		'19.90' => array('min'=>3, 'max'=> 7),
		'21.90' => array('min'=>2, 'max'=> 7),
		'24.90' => array('min'=>2, 'max'=> 4),
		'29.90' => array('min'=>1, 'max'=> 4),
		'39.90' => array('min'=>1, 'max'=> 3),
		'49.90' => array('min'=>1, 'max'=> 3),
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