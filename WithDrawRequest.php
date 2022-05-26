<?php

require_once 'core/init.php';
$Id = $_GET['q'];

$user = new User();
if(!$user->isLoggedIn()){
	Redirect::to('index.php');
	
}

if($user->hasPermission()=="ass"){
    $invest = new MoneyRaise($Id);
    $group = 1;
    $link = 'PersonalAreaAss_.php';
  }else if($user->hasPermission()=="inv"){

       $invest = new Invest($Id);
 		$group = 3;
 		$link = 'PAinvestor.php';
    }

$req = new PullRequest();
$req->create(array(
	'group'=>$group,
	'Rid'=>$Id
  ));

	$invest ->update(array(
	'requested'=>1
));




Redirect::to($link);

	?>