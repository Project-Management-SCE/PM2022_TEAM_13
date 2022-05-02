<?php
class ValidatePassTest extends PHPUnit_Framework_TestCase {
	
	
	public function testLength(){
		$valPass = new ValidatePass();
		$this->assertFalse($valPass->validLength('1234'));
		
		
	}
}
