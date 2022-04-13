<?php
class Amuta {
	private $_db,
			$_data;
	
	public function __construct($amuta = null){
		$this->_db = DB::getInstance();
		$this->find($amuta);
		
	}
	public function create($fields=array()){
		if(!$this->_db->insert('association',$fields)){
			throw new Exception('There was a problem creating an account.');
		}
		
	}
	public function find($id=null){
				$field = (is_numeric($id)) ? 'id' : 'username';
				$data = $this->_db->get('association',array($field,'=',$id));
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
		
		if(!$this->_db->update('association',$id,$fields)){
			throw new Exception('There was a problem updating');
			
		}
		
	}
	
	
	
}



?>