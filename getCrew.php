<?php
require_once 'core/init.php';
require_once 'connectionoop.php';

$user = new User();
if(!$user->isLoggedIn()){
	Redirect::to('index.php');
	
}
$username = $user->data()->username;
 
header('Content-Type: application/json');


$query1 = sprintf("SELECT id,Aname,Target,TargetStart,TargetEnd FROM association WHERE username='$username'");
//execute query
$result1 = $mysqli->query($query1);

//loop through the returned data
$data1 = array();
foreach ($result1 as $row) {
  $data1[] = $row;
}
$id=$data1[0]['id'];

$result1->close();

//query to get data from the table
$query = sprintf("SELECT * FROM crew WHERE Aid='$id'");

//execute query
$result = $mysqli->query($query);

//loop through the returned data
$data = array();
foreach ($result as $row) {
  $data[] = $row;
}

//free memory associated with result
$result->close();

$mysqli->close();
 
echo json_encode($data);
?>