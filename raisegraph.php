<?php
//setting header to json
header('Content-Type: application/json');

require_once 'connectionoop.php';

/*$query = sprintf("SELECT r.type,r.amount,r.BuyPrice,r.SellPrice,r.StartDate,r.EndDate,a.Aname,a.Target,a.Target-start,a.Target-end
FROM raises r INNER JOIN assosiations a ON r.Aid = a.Aid WHERE Aid=1");
*/
//query to get data from the table
$query = sprintf("SELECT type,amount,BuyPrice,SellPrice,StartDate,EndDate FROM raises WHERE Aid=1");
$query2 = sprintf("SELECT Aname,Target,TargetStart,TargetEnd FROM assosiations WHERE Aid=1");
//execute query
$result = $mysqli->query($query);

//loop through the returned data
$data = array();
foreach ($result as $row) {
  $data[] = $row;
}

//free memory associated with result
$result->close();
$result = $mysqli->query($query2);

foreach ($result as $row) {
  $data[] = $row;
}
$result->close();
//close connection
$mysqli->close();

//now print the data
print json_encode($data);

/*<?php

header('Content-Type : application/json');
header('Content-type: text/plain; charset=utf-8');
include'connection.php';

//query to get data from the table

$sql = "SELECT 	type,BuyPrice FROM raises WHERE Aid=1";

if (mysqli_query($conn, $sql)) {
  
} else {
  echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
//execute query
$result = mysqli_query($conn, $sql);

//loop through the returned data
$data = array();
foreach ($result as $row) {
  $data[] = $row;
  
}
foreach($data as $i){
	foreach($i as $col){
		echo $col."  ";
		
	}
	
}

mysqli_close($conn);

//now print the data
print json_encode($data);


?>*/