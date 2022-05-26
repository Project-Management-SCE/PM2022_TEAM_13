<?php 

header('Content-Type: application/json');

require_once 'core/init.php';
require_once 'connectionoop.php';

$user = new User();
if(!$user->isLoggedIn()){
  Redirect::to('index.php');
  
}
$username = $user->data()->username;
 


$data = array(
  "inv"=>array(),
  "file"=>array()
);
$query2 = sprintf("SELECT * FROM invests WHERE 1");
$result = $mysqli->query($query2);

foreach ($result as $row) {
  $data["inv"][] = $row;
}

$result->close();

$query = sprintf("SELECT * FROM investfiles WHERE 1");

//execute query
$result = $mysqli->query($query);

foreach ($result as $row) {
  $data["file"][] = $row;
}

//close connection
$mysqli->close();

//now print the data
print json_encode($data);


?>