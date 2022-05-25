<?php
require_once 'core/init.php';

$amn=$_POST['amount2'];
$inv=$_POST['Invid2'];

$user = new User();

$invest = new Invest($inv);
$invest->update(array(
	'aprooved'=>1
));

Redirect::to("PAinvestor.php");
?>