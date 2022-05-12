<?php
require_once 'core/init.php';
require_once 'connectionoop.php';
$Rid=$_POST['Rid'];

$query1 = sprintf("DELETE FROM moneyraise WHERE id='$Rid'");
//execute query
$result1 = $mysqli->query($query1);
$query1 = sprintf("DELETE FROM accountmovements WHERE Rid='$Rid'");
$result1 = $mysqli->query($query1);

$mysqli->close();
Redirect::to("generalData.php");
?>