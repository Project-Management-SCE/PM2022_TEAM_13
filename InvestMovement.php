<?php
class InvestMovement {
	private $_db,
			$_data;
	
	public function __construct($mov = null){
		$this->_db = DB::getInstance();
		$this->find($mov);
		
	}
	public function create($fields=array()){
		if(!$this->_db->insert('investmovements',$fields)){
			throw new Exception('There was a problem creating an account movement.');
		}
		
	}
	public function find($id){
				$field = 'id';
				$data = $this->_db->get('investmovements',array($field,'=',$id));
				if($data->count()){
					$this->_data =$data->first();
					
					return true;
					
				}
				return false;
	
			}


	public function find2($id){
				$field = 'Rid';
				$data = $this->_db->get('investmovements',array($field,'=',$id));
				if($data->count()){
					$this->_data =$data->first();
					
					return true;
					
				}
				return false;
	
			}		
		
	
	
	public function exists(){
		return (!empty($this->_data)) ? true :false;
		
	}
	
	
	public function data(){
		return $this->_data;
		
	}
	
	
	
	public function update($fields=array(),$id=null){
		
		if(!$id){
			
			$id=$this->data()->id;
		}
		
		if(!$this->_db->update('investmovements',$id,$fields)){
			throw new Exception('There was a problem updating account movement.');
			
		}
		
	}
	
	
	
}



?>