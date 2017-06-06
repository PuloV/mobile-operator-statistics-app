<?php

require_once 'app/utils/random/Randomizer.php';
/**
* class that handles the taking of a random age values
*/
class AgeRandomizer extends Randomizer {

	private static $probabilities = array(
		'16' => array('min'=>1, 'max'=> 4),
		'17' => array('min'=>1, 'max'=> 4),
		'18' => array('min'=>1, 'max'=> 4),
		'19' => array('min'=>1, 'max'=> 4),
		'20' => array('min'=>1, 'max'=> 4),
		'21' => array('min'=>3, 'max'=> 5),
		'22' => array('min'=>3, 'max'=> 5),
		'23' => array('min'=>3, 'max'=> 5),
		'24' => array('min'=>3, 'max'=> 5),
		'25' => array('min'=>3, 'max'=> 5),
		'26' => array('min'=>3, 'max'=> 5),
		'27' => array('min'=>3, 'max'=> 5),
		'28' => array('min'=>3, 'max'=> 5),
		'29' => array('min'=>3, 'max'=> 5),
		'30' => array('min'=>3, 'max'=> 4),
		'31' => array('min'=>1, 'max'=> 4),
		'32' => array('min'=>1, 'max'=> 4),
		'33' => array('min'=>1, 'max'=> 4),
		'34' => array('min'=>1, 'max'=> 4),
		'35' => array('min'=>1, 'max'=> 4),
		'36' => array('min'=>1, 'max'=> 4),
		'37' => array('min'=>1, 'max'=> 4),
		'38' => array('min'=>1, 'max'=> 4),
		'39' => array('min'=>1, 'max'=> 4),
		'40' => array('min'=>1, 'max'=> 4),
		'41' => array('min'=>1, 'max'=> 3),
		'42' => array('min'=>1, 'max'=> 3),
		'43' => array('min'=>1, 'max'=> 3),
		'44' => array('min'=>1, 'max'=> 3),
		'45' => array('min'=>1, 'max'=> 3),
		'46' => array('min'=>1, 'max'=> 3),
		'47' => array('min'=>1, 'max'=> 3),
		'48' => array('min'=>1, 'max'=> 3),
		'49' => array('min'=>1, 'max'=> 3),
		'50' => array('min'=>0, 'max'=> 3),
		'51' => array('min'=>0, 'max'=> 3),
		'52' => array('min'=>0, 'max'=> 3),
		'53' => array('min'=>0, 'max'=> 3),
		'54' => array('min'=>0, 'max'=> 3),
		'55' => array('min'=>0, 'max'=> 3),
		'56' => array('min'=>0, 'max'=> 3),
		'57' => array('min'=>0, 'max'=> 3),
		'58' => array('min'=>0, 'max'=> 3),
		'59' => array('min'=>0, 'max'=> 3),
		'60' => array('min'=>0, 'max'=> 3),
		'61' => array('min'=>0, 'max'=> 3),
		'62' => array('min'=>0, 'max'=> 3),
		'63' => array('min'=>0, 'max'=> 3),
		'64' => array('min'=>0, 'max'=> 3),
		'65' => array('min'=>0, 'max'=> 3),
		'66' => array('min'=>0, 'max'=> 2),
		'67' => array('min'=>0, 'max'=> 2),
		'68' => array('min'=>0, 'max'=> 2),
		'69' => array('min'=>0, 'max'=> 2),
		'70' => array('min'=>0, 'max'=> 1),
		'71' => array('min'=>0, 'max'=> 1),
		'72' => array('min'=>0, 'max'=> 1),
		'73' => array('min'=>0, 'max'=> 1),
		'74' => array('min'=>0, 'max'=> 1),
		'75' => array('min'=>0, 'max'=> 1),
		'76' => array('min'=>0, 'max'=> 1),
		'77' => array('min'=>0, 'max'=> 1),
		'78' => array('min'=>0, 'max'=> 1),
		'79' => array('min'=>0, 'max'=> 1),
		'80' => array('min'=>0, 'max'=> 1)
	);
	
	function __construct(){

		parent::__construct(self::generateProbableData(self::$probabilities), true);
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

		$data = array_fill(0, $min + $random_occurrence, $value);
		return $data ? $data : array();
	}
}