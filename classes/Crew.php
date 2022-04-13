<?php
class Crew {
	private $_db,
			$_data;
	
	public function __construct($crew = null){
		$this->_db = DB::getInstance();
		$this->find($crew);
		
	}
	public function create($fields=array()){
		if(!$this->_db->insert('crew',$fields)){
			throw new Exception('There was a problem creating crew member.');
		}
		
	}
	public function find($id=null){
				$field = 'id';
				$data = $this->_db->get('crew',array($field,'=',$id));
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
		
		if(!$this->_db->update('crew',$id,$fields)){
			throw new Exception('There was a problem updating');
			
		}
		
	}
	
	
	
}



?>