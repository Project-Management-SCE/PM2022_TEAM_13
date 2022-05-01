<?php
//require_once 'core/init.php';
function escape ($string){
	return htmlentities($string,ENT_QUOTES,'UTF-8');
	
	
}
class Validate{
	private $_passed = false,
			$_errors = array(),
			$_db = null;
	
	// public function __construct(){
	// 	$this->_db = DB::getInstance();
		
	// }	
	public function check($source , $items = array()){
		foreach($items as $item =>$rules){
			foreach($rules as $rule=>$rule_value){
				
				$value = trim($source[$item]);
				$item=escape($item);
				
				if($rule==='required'&& empty($value)){
					$this->addError("{$item} is required");
				}else if (!empty($value)){
					switch($rule){
						case 'min':
							if(strlen($value)<$rule_value){
								$this->addError("{$item} must be a minumum of {$rule_value}");
							}
						break;
						case 'max':
							if(strlen($value)>$rule_value){
								$this->addError("{$item} must be a maximum of {$rule_value}");
							}	
						
						break;
						case 'matches':
							if($value != $source[$rule_value]){
								$this->addError("{$rule_value} must match {$item}");
							}
						
						break;
						
						case 'numeric':
							
							if(!is_numeric($value)){
								$this->addError("{$item} has to be a number");
							}
						
						break;

						case 'ValidEmail':
							if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
						     $this->addError("{$item} has to be a Valid Email");
						    }
							
						break;

						case 'numbercontain':
							$isThereNumber = false;

							for ($i = 0; $i < strlen($value); $i++) {
						    if ( ctype_digit($value[$i]) ) {
						        $isThereNumber = true;
						        break;
						    }
						}


							if($isThereNumber==false){
								$this->addError("{$item} has to contain a number");
							}
						
						break;
						
					}
				}
					
			}
			
		}
		if(empty($this->_errors)){
				$this->_passed = true;
			}
			return $this;
	}
	
	private function addError($error){
		$this->_errors[]=$error;
		
	}
	public function errors(){
		return $this->_errors;
		
	}
	public function passed (){
		return $this->_passed;
		
		
	}
}
class ValidatePassTest extends PHPUnit_Framework_TestCase {
	
	public function testLength(){
		$validate = new Validate();
		$_POST['password']='12345';
		$validation = $validate->check($_POST,array(
			'password'=>array('min'=>6,
				'max'=>20)

		));
		$this->assertFalse($validate->passed());
		$validate = new Validate();
		$_POST['password']='1234526266615';
		$validation = $validate->check($_POST,array(
			'password'=>array('min'=>6,
				'max'=>20)

		));
		$this->assertTrue($validate->passed());
		
		
	}

	public function testMatch(){
		$validate = new Validate();
		$_POST['password']='12345';
		$_POST['confirm-password']='123457';
		$validation = $validate->check($_POST,array(
			'password'=>array('matches'=>'confirm-password')
		));
		$this->assertFalse($validate->passed());
		$validate = new Validate();
		$_POST['password']='123457';
		$_POST['confirm-password']='123457';
		$validation = $validate->check($_POST,array(
			'password'=>array('matches'=>'confirm-password')
		));
		$this->assertTrue($validate->passed());
		
		
	}
	
public function testNumberContain(){
		$validate = new Validate();
		$_POST['password']='abcd2';
		
		$validation = $validate->check($_POST,array(
			'password'=>array('numbercontain'=>true)
		));
		$this->assertTrue($validate->passed());
		
	}


	public function testValidEmail(){
		$validate = new Validate();
		$_POST['email']='abcd2@gmail.com';
		
		$validation = $validate->check($_POST,array(
			'email'=>array('ValidEmail'=>true)
		));
		$this->assertTrue($validate->passed());

		$validate = new Validate();
		$_POST['email']='abcd2gmail.com';
		
		$validation = $validate->check($_POST,array(
			'email'=>array('ValidEmail'=>true)
		));
		$this->assertFalse($validate->passed());
		
	}


	
}

