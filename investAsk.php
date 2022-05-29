<?php 
require_once 'core/init.php';
require_once 'connectionoop.php';

$user = new User();
if(!$user->isLoggedIn()){
	Redirect::to('index.php');
	
}
$username = $user->data()->username;

$pid = $_GET['pid'];

header('Content-Type: application/json');

$query = sprintf("SELECT projects.id,projects.Pname ,projects.Target , projects.Pstart , projects.Pend ,projects.hasfile , association.Aname FROM projects INNER JOIN association ON association.id = projects.Aid WHERE projects.id='$pid'");

//execute query
$result = $mysqli->query($query);
$data=array();
foreach ($result as $row) {
  $data[] = $row;
}

//free memory associated with result
$result->close();
$mysqli->close();
 $inv = new Invest();
 $pro = new Project($data[0]['id']);
try{
			$inv->create(array(
				'investor' =>$username,
				'Pid' =>$data[0]['id'],
				'Pname' =>$data[0]['Pname'],
				'amount' =>$data[0]['Target'],
				'Aname' =>$data[0]['Aname'],
				'date' => date("Y-m-d") 
			));
			$pro->update(array(
				'hasinv'=>1,
				'investor'=>$username
			));

			Session::flash('home','you have added the invets !');
			Redirect::to('PAinvestor.php');
			
		}catch(Exception $e){
			die($e->getMessage());
		}


?>