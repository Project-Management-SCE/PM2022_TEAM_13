<?php
require_once 'core/init.php';
$id = $_GET['id'];
echo $id.'<br>';
$user = new User();
if(!$user->isLoggedIn()|| !$user->hasPermission()=="admin"){
	Redirect::to('index.php');
	
}
$db = DB::getInstance();
$db->delete('association',array('id','=',$id));
Redirect::to('UsersData.php');


?>
