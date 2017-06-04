<?php 
/**
* class that handles the taking of a random value from array of probable data 
*/
class Randomizer {
	protected $_probable;
	protected $_with_removing;
	function __construct(array $probable, bool $with_removing = true){
		$this->_probable = $probable;
		$this->_with_removing = $with_removing;
	}

	public function shuffle(int $times=2){
		while ($times > 0) {
			$this->_probable = shuffle($this->_probable);
		}
	}

	public function isWithRemoving(){
		return $this->_with_removing ? true : false;
	}

	public function seeHead(){
		return $this->_probable[0];
	}

	public function takeHead(){
		return array_shift($this->_probable);
	}

	public function getValue(){
		if (!count($this->_probable)) {
			throw new Exception("No probable values to get from ! ");
		}
		
		$this->shuffle(rand() % 10);

		$value = $this->isWithRemoving() ? $this->takeHead() : $this->seeHead();

		return $value;
	}
}