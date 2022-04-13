<?php

session_start();


ini_set('display_errors','On');
$GLOBALS['config']=array(
	'mysql'=>array(
		'host'=>'freelovedb-do-user-11110282-0.b.db.ondigitalocean.com',
		'username'=>'omer',
		'password'=>'13323Gunr',
		'db'=>'freelove',
		'options'=>array(
	PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
 	 PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
  	PDO::ATTR_EMULATE_PREPARES => false)

	),
	'remember'=>array(
		'cookie_name'=>'hash',
		'cookie_expiry'=>604800
	),
	'session'=>array(
		'session_name'=>'user',
		'token_name'=>'token'
	)
); 

spl_autoload_register(function($class){
	require_once 'classes/' .$class. '.php';
});

require_once 'functions/sanitize.php';


if(Cookie::exists(Config::get('remember/cookie_name')) && !Session::exists(Config::get('session/session_name'))){
		$hash = Cookie::get(Config::get('remember/cookie_name'));
		$hashCheck = DB::getInstance()->get('users_session',array('hash','=',$hash));
		if($hashCheck->count()){
			$user = new User($hashCheck->first()->user_id);
			$user->login();
			
			
		}
}


