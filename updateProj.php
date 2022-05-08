<?php
require_once 'core/init.php';

$id= $_REQUEST['id'];
$sub = 'sub'.$id;
$Rsub='Rsub'.$id;
if(isset($_POST[$sub])){
	$Pend=$_POST['Pend'.$id];
	$Aid=$_POST['Aid'.$id];
	$Pstart=$_POST['Pstart'.$id];
	$Target=$_POST['Target'.$id];
	$Pname=$_POST['Pname'.$id];
	 


 	$validate =new Validate();
	$validation = $validate->check($_POST, array(
		'Pname'.$id=>array(
			'required'=>true
		),
		'Target'.$id=>array(
			'numeric'=>true,
			'required'=>true
		),
		'Pstart'.$id=>array(
			'required'=>true
		),
		'Pend'.$id=>array(
			'required'=>true
		)
	));

	if($validation->passed()){
		
		$amut =new Amuta($Aid);
		$tr = $amut->data()->Target;
		$pro = new Project($id);
		$ptr = $pro->data()->Target;
		try{
			$pro->update(array(
				'Pname' =>$Pname,
				'Target' =>$Target,
				'Pstart' =>$Pstart,
				'Pend' =>$Pend
			));
			if($Pend>$amut->data()->TargetEnd){
				$amut->update(array(
				'TargetEnd'=>$Pend
			));
				
			}
			$amut->update(array(
				'Target'=>$tr-$ptr+$Target
			));
			
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