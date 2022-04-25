<?php
 header('Content-Type: application/json');

require_once 'core/init.php';
require_once 'connectionoop.php';

$user = new User();
if(!$user->isLoggedIn()){
	Redirect::to('index.php');
	
}
$username = $user->data()->username;

$q = $_GET['q'];


//query to get data from the table
$query = sprintf("DELETE FROM crew WHERE  id='$q'");

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
 Redirect::to('PersonalAreaAss_.php');
 ?>
