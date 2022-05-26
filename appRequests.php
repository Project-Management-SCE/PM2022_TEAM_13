<?php 

require_once 'core/init.php';

require_once 'connectionoop.php';


$id = $_GET['id'];

$group = $_GET['group'];

$amount = $_GET['amount'];



if($group == 3){

	$inv = new Invest($id);
	
$query = sprintf("UPDATE pullrequests SET aprooved = 1 WHERE Rid ='$id'");
//execute query
$result = $mysqli->query($query);


$query = sprintf("UPDATE invests SET pulled = 1 WHERE id ='$id'");
//execute query
$result = $mysqli->query($query);


//close connection
$mysqli->close();

$mov = new InvestMovement();


try{
$mov->create(
	array(
		'investor'=>$inv->data()->investor,
		'investid'=>$inv->data()->id,
		'amount'=>-$amount,
		'date'=>date("Y-m-d"),
		'Pid'=>$inv->data()->Pid,
		'Aname'=>'משיכה לחשבון'
	)
);

}catch(Exception $e){
			die($e->getMessage());
		}


}
else if($group == 1){
$query = sprintf("UPDATE pullrequests SET aprooved = 1 WHERE Rid ='$id'");
//execute query
$result = $mysqli->query($query);

$query = sprintf("UPDATE moneyraise SET pulled = 1 WHERE id ='$id'");
//execute query
$result = $mysqli->query($query);

$mr = new MoneyRaise($id);

$mov = new AccountMovement();

try{
$mov->create(
	array(
		'Aid'=>$mr->data()->Aid,
		'Rid'=>$id,
		'amount'=>-$amount,
		'date'=>date("Y-m-d"),
		'source'=>'משיכה לחשבון',
		'collected'=>1
	)
);

}catch(Exception $e){
			die($e->getMessage());
		}


}
Redirect::to('Requests.php');

?>