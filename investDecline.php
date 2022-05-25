<?php
require_once 'core/init.php';
require_once 'connectionoop.php';
$Pid=$_POST['Pid2'];
$inv=$_POST['Invid2'];
$query1 = sprintf("DELETE FROM invests WHERE id='$inv'");
//execute query
$result1 = $mysqli->query($query1);
$query1 = sprintf("UPDATE projects SET hasinv = 0 , investor = NULL WHERE id='$Pid'");
$result1 = $mysqli->query($query1);


$mysqli->close();
Redirect::to("investAproove.php");
?>