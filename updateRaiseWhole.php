<?php
require_once 'core/init.php';
	
$id= $_REQUEST['id'];
$Rsub='Rsub'.$id;
if(isset($_POST[$Rsub])){

	$CollectDate=$_POST['CollectDate'.$id];
	$StartDate=$_POST['StartDate'.$id];
	$SellPrice=$_POST['SellPrice'.$id];
	$BuyPrice=$_POST['BuyPrice'.$id];
	$amount=$_POST['amount'.$id];
	$type=$_POST['type'.$id];

	$validate =new Validate();
	$validation = $validate->check($_POST, array(
		'CollectDate'.$id=>array(
			'required'=>true
		),
		'StartDate'.$id=>array(
			
			'required'=>true
		),
		'SellPrice'.$id=>array(
			'numeric'=>true,
			'required'=>true
		),
		'BuyPrice'.$id=>array(
			'numeric'=>true
		),
		'amount'.$id=>array(
			'numeric'=>true,
			'required'=>true
		),
		'type'.$id=>array(
			'required'=>true
		)
	));

	if($validation->passed()){
		
		
		$mr= new MoneyRaise($id);
		$st=$mr->data()->StartDate;
		$ct=$mr->data()->CollectDate;

		try{
			$mr->update(array(
				'CollectDate' =>$CollectDate,
				'StartDate' =>$StartDate,
				'SellPrice' =>$SellPrice,
				'BuyPrice' =>$BuyPrice,
				'amount' =>$amount,
				'type' =>$type
				
			));
			
			
		require_once 'connectionoop.php';
		$query = sprintf("UPDATE accountmovements SET amount='$SellPrice' , date='$CollectDate' ,source ='$type' 
		 WHERE Rid='$id' AND date='$ct'");
		//execute query
		$mysqli->query($query);

		$br = -1*$BuyPrice*$amount;

		$query = sprintf("UPDATE accountmovements SET amount='$br' , date='$StartDate' ,source ='$type'
		 WHERE Rid='$id' AND date ='$st'");
		//execute query
		$mysqli->query($query);
			
		$mysqli->close();
	
		Redirect::to('generalData.php');
			
		}catch(Exception $e){
			die($e->getMessage());
		}
	}else{
		
		
		foreach($validation->errors() as $error){
			echo '<p align="left">'.$error . '</p>';
		}
		echo '<a href="generalData.php">חזור לדף הקודם</a>';
	}


}

?>