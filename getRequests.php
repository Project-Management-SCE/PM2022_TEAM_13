<?php 

header('Content-Type: application/json');

require_once 'core/init.php';
require_once 'connectionoop.php';

$user = new User();
if(!$user->isLoggedIn()){
  Redirect::to('index.php');
  
}

 


$data = array(
  "inv"=>array(),
  "raise"=>array()
);
$query2 = sprintf("SELECT * FROM pullrequests INNER JOIN invests ON pullrequests.Rid =invests.id WHERE pullrequests.group=3");
$result = $mysqli->query($query2);

foreach ($result as $row) {
  $data["inv"][] = $row;
}

$result->close();

$query = sprintf("SELECT * FROM pullrequests INNER JOIN moneyraise ON pullrequests.Rid =moneyraise.id INNER JOIN association ON moneyraise.Aid=association.id  WHERE pullrequests.group=1");

//execute query
$result = $mysqli->query($query);

foreach ($result as $row) {
  $data["raise"][] = $row;
}

//close connection
$mysqli->close();

//now print the data
print json_encode($data);


?>