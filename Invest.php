<?php
class Invest {
	private $_db,
			$_data;
	
	public function __construct($pro = null){
		$this->_db = DB::getInstance();
		$this->find($pro);
		
	}
	public function create($fields=array()){
		if(!$this->_db->insert('invests',$fields)){
			throw new Exception('There was a problem creating a project');
		}
		
	}
	public function find($id=null){
				$field = 'id' ;
				$data = $this->_db->get('invests',array($field,'=',$id));
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
		
		if(!$this->_db->update('invests',$id,$fields)){
			throw new Exception('There was a problem updating');
			
		}
		
	}
	
	
	
}



?>