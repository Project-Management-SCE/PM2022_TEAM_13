<?php 

header('Content-Type: application/json');

require_once 'core/init.php';
require_once 'connectionoop.php';

$id = $_GET['id'];


$data = array(
  "raise"=>array(),
  "proj"=>array(),
  "crew"=>array()
);
$query2 = sprintf("SELECT * FROM moneyraise WHERE Aid='$id'");
$result = $mysqli->query($query2);

foreach ($result as $row) {
  $data['raise'][] = $row;
}

$query2 = sprintf("SELECT * FROM projects WHERE Aid='$id'");
$result = $mysqli->query($query2);

foreach ($result as $row) {
  $data['proj'][] = $row;
}

$query2 = sprintf("SELECT * FROM crew WHERE Aid='$id'");
$result = $mysqli->query($query2);

foreach ($result as $row) {
  $data['crew'][] = $row;
}
$result->close();
//close connection
$mysqli->close();

//now print the data
print json_encode($data);


?>