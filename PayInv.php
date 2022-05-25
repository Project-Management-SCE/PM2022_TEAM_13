<?php
require_once 'core/init.php';
if(isset($_POST['amount'])){
	$amn=$_POST['amount'];
	$inv=$_POST['Invid'];
 $user = new User();
 $username=$user->data()->username;

}else if(isset($_POST['amount3'])){
	$amn=$_POST['amount3'];
	$inv=$_POST['Invid3'];
	$username = $_POST['investor3'];
}




$pay = new Payment();
$pay->create(array(
	'username'=>$username,
	'amount'=>$amn,
	'date'=>date("Y-m-d")

));

if($_POST['Invid']!=null){
	$invest = new Invest($inv);
	$invest->update(array(
	'aprooved'=>1,
	'payed'=>1
));

}


$user = new User();
 

if($user->data()->group==3){
	Redirect::to("PAinvestor.php");
}else {
	Redirect::to("investAproove.php");
}

?>