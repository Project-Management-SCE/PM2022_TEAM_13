<?php 
 header('Content-Type: application/json');

require_once 'core/init.php';
require_once 'connectionoop.php';

$user = new User();
if(!$user->isLoggedIn()){
	Redirect::to('index.php');
	
}
$username = $_GET['q'];


$query1 = sprintf("SELECT investmovements.investor,investmovements.amount,investmovements.Aname,projects.Pname,investmovements.date FROM investmovements INNER JOIN projects ON investmovements.Pid=projects.id  WHERE investmovements.investor='$username'");
//execute query
$result1 = $mysqli->query($query1);

//loop through the returned data
$data = array(
  "inv"=>array(),
  "pay"=>array()
);
foreach ($result1 as $row) {
  $data1['inv'][] = $row;
}

$query1 = sprintf("SELECT * FROM Payments  WHERE username='$username'");
//execute query
$result1 = $mysqli->query($query1);

foreach ($result1 as $row) {
  $data1['pay'][] = $row;
}

$mysqli->close();
 
echo json_encode($data1);
?>