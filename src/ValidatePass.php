<?php
class ValidatePass {
	const MIN_LENGTH=6;
	const MAX_LENGTH=20;
	
	public function validLength($password){
		$len=strlen($password);
		return $len>=self::MIN_LENGTH&&$len<=self::MAX_LENGTH;
		
	}
}