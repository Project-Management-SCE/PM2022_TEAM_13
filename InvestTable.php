<?php 
 header('Content-Type: application/json');

require_once 'core/init.php';
require_once 'connectionoop.php';

$user = new User();
if(!$user->isLoggedIn()){
	Redirect::to('index.php');
	
}
$username = $_GET['q'];


$query1 = sprintf("SELECT users.first_name,users.last_name,invests.amount,invests.Aname,invests.Pname,invests.gainper,invests.collected,invests.collectdate,invests.date,invests.payed,projects.Pend FROM invests INNER JOIN projects ON invests.Pid=projects.id INNER JOIN users ON invests.investor=users.username WHERE invests.investor='$username'");
//execute query
$result1 = $mysqli->query($query1);

//loop through the returned data
$data1 = array();
foreach ($result1 as $row) {
  $data1[] = $row;
}

$mysqli->close();
 
echo json_encode($data1);
?>