<?php
require_once 'core/init.php';


$id= $_REQUEST['id'];
// $user=new User($id);
// $userorigin = $user->data()->username;

$sub = 'sub'.$id;
$Rsub='Rsub'.$id;
if(isset($_POST[$Rsub])){
	$Aname=$_POST['Aname'.$id];
	$Anumber=$_POST['Anumber'.$id];
	$mobileContact=$_POST['mobileContact'.$id];
	$TargetStart=$_POST['TargetStart'.$id];
	$TargetStart=$_POST['TargetStart'.$id];
	
	 


 	$validate =new Validate();
 	
 		$validation = $validate->check($_POST, array(
		'Aname'.$id=>array(
			'required'=>true
		),
		'Anumber'.$id=>array(
			'required'=>true
		),
		'mobileContact'.$id=>array(
			'required'=>true
		),
		'TargetStart'.$id=>array(
			'required'=>true
		),
		'TargetStart'.$id=>array(
			'required'=>true
		)
	));

 	
	if($validation->passed()){

		try{
			$amut = new Amuta($id);
			$amut->update(array(
				'Aname' =>$Aname,
				'Anumber' =>$Anumber,
				'mobileContact' =>$mobileContact,
				'TargetStart' =>$TargetStart,
				'TargetStart' =>$TargetStart
			));
			
			
			Redirect::to('UsersData.php');
			
		}catch(Exception $e){
			die($e->getMessage());
		}
	}else{
		
		
		foreach($validation->errors() as $error){
			echo '<p align="left">'.$error . '</p>';
		}
		echo '<a href="UsersData.php">חזור לדף הקודם</a>';
	}
	
		
}

  
?>