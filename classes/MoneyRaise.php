<?php
class MoneyRaise {
	private $_db,
			$_data;
	
	public function __construct($raise = null){
		$this->_db = DB::getInstance();
		$this->find($raise);
		
	}
	public function create($fields=array()){
		if($this->_db->insert('moneyraise',$fields)){
			
			
		}else{
			
			throw new Exception('There was a problem creating a raise');
		}
		
	}
	public function find($id){
				$field = 'id';
				$data = $this->_db->get('moneyraise',array($field,'=',$id));
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
		
		if(!$this->_db->update('moneyraise',$id,$fields)){
			throw new Exception('There was a problem updating a raise');
			
		}
		
	}
	
	public function last() {
        return $this->_last_id;
    }
	
}



?>