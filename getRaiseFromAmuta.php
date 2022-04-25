<?php 

header('Content-Type: application/json');

require_once 'core/init.php';
require_once 'connectionoop.php';

$id = $_GET['id'];


$data = array();
$query2 = sprintf("SELECT * FROM moneyraise WHERE Aid='$id' AND collected =0");
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