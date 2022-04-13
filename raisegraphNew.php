<?php
//setting header to json
header('Content-Type: application/json');
require_once 'core/init.php';
require_once 'connectionoop.php';

$user = new User();
if(!$user->isLoggedIn()){
	Redirect::to('index.php');
	
}
$username = $user->data()->username;



//query to get data from the table

$query = sprintf("SELECT id,Aname,Target,TargetStart,TargetEnd FROM association WHERE username='$username'");
//execute query
$result = $mysqli->query($query);

//loop through the returned data
$data = array();
foreach ($result as $row) {
  $data[] = $row;
}
$id=$data[0]['id'];

//free memory associated with result
$result->close();


$query2 = sprintf("SELECT type,amount,BuyPrice,SellPrice,StartDate,CollectDate,collected FROM moneyraise WHERE Aid='$id'");
$result = $mysqli->query($query2);

foreach ($result as $row) {
  $data[] = $row;
}
$result->close();
//close connection
$mysqli->close();

//now print the data
print json_encode($data);

?>