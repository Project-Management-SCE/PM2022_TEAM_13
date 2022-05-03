<?php
require_once 'core/init.php';
$user = new User();

if(!$user->isLoggedIn()){
	Redirect::to('index.php');
	
}
	
?>
<!DOCTYPE html>
<html>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="https://fonts.googleapis.com/css2?family=Assistant:wght@500;700&display=swap" rel="stylesheet">
<link href="freeloveStyle.css" rel="stylesheet">
<link href="contact-form.css" rel="stylesheet">
<style>

</style>
</head>
<body>

<div class="topnav" id="navbar">
 <a href="#default" id="logo"><img style="position: absolute;top: 2.5vw;height: 4vw;width: 4vw;" src="impactlogo.jpeg" alt="FreeLoveLogo"></a>
<div id="navbar-right">
  <a href="javascript:void(0);" class="icon" onclick="myFunction()">
    <i class="fa fa-bars"></i></a>
	<a href="login.php"> להתחבר </a> 
	<a href="index.php" class="active">דף הבית</a>
</div>	
</div>	
<div id="main">


<div style="background-color:white;border-radius: 16px;width:65%;height: auto;margin: auto;display: block;">
    <img src="impactlogo.jpeg" alt="FreeLoveLogo"  style="float:left;height: 16vw;width: 16vw;position: relative;left: 5vw;">


<h1 align="right" style="padding-bottom:10vw;font-size:5vw;padding-right:25px;position: relative;top: 5vw;" ><?php echo "שלום  ".$user->data()->first_name ; ?></h1>

</div>
<div class="fcf-body">

    <div id="fcf-form">
    <h1 class="fcf-h3">מלא את הפרטים על מנת להשלים את ההרשמה</h1>
	
	<?php
	if(Input::exists()){
	if(Token::check(Input::get('token'))){
	$validate =new Validate();
	$validation = $validate->check($_POST, array(
		'username'=>array(
			'required'=>true,
			'min'=>3,
			'max'=>25,
			'unique'=>'users'
		),
		'Email'=>array(
			'required'=>true,
			'unique'=>'users'	
		),
		'password'=>array(
			'required'=>true,
			'min'=>6
		),
		'password_again'=>array(
			'required'=>true,
			'matches'=>'password'
			
		)
	));
	
	if($validation->passed()){
		Session::flash('success','You registered successfully!');
		$user= new User();
		
		$salt = Hash::salt(32);
		
		try{
			$user->update(array(
				'username' =>Input::get('username'),
				'password' =>Hash::make(Input::get('password'),$salt),
				'salt' =>$salt,
				'assigned' =>1,
				'joined' =>date('Y-m-d H:i:s'),
				'email' =>Input::get('Email')
			));
			
			Session::flash('home','you have benn registered and now can log in!');
			$m = new Mailer();
			$m->EmailConfirm(Input::get('Email'));
			Redirect::to('index.php');
			
		}catch(Exception $e){
			die($e->getMessage());
		}
	}else{
		
		
		foreach($validation->errors() as $error){
			echo '<p align="left">'.$error . '</p>';
		}
	}
	
	}	
}
?>
		<form class="fcf-form-class" action="" method="post">
			<div class="fcf-form-group">
				<label class="fcf-label" for="username">שם משתמש</label>
				<div class="fcf-input-group">
					<input type="text" class="fcf-form-control" name="username" id="username" value="<?php echo escape(Input::get('username'));  ?>" autocomplete="off">
				</div>
			</div>
			<div class="fcf-form-group">
				<label class="fcf-label" for="Email">דואר אלקטרוני</label>
				<div class="fcf-input-group">	
					<input type="text" class="fcf-form-control" name="Email" id="Email" value="<?php echo escape(Input::get('Email'));  ?>" autocomplete="off">
				</div>	
			</div>
			<div class="fcf-form-group">
				<label class="fcf-label" for="password">סיסמא</label>
				<div class="fcf-input-group">
					<input type="password" class="fcf-form-control" name="password" id="password" value="" autocomplete="off">
				</div>
			</div>
			<div class="fcf-form-group">
				<label class="fcf-label" for="password_again">אימות סיסמא</label>
				<div class="fcf-input-group">	
					<input type="password" class="fcf-form-control" name="password_again" id="password_again" value="" autocomplete="off">
				</div>
			</div>
			
			
			<input type="submit" class="fcf-btn fcf-btn-primary fcf-btn-lg fcf-btn-block" value="הירשם">
			<input type="hidden" name="token" value="<?php echo Token::generate();?>">
			
			</form>	
	</div>
</div>	
</div>	
	</body>
</html>
<script>
function openNav() {
  document.getElementById("mySidebar").style.width = "250px";
  document.getElementById("main").style.marginLeft = "250px";
}

function closeNav() {
  document.getElementById("mySidebar").style.width = "0";
  document.getElementById("main").style.marginLeft= "0";
}
</script>
<script>
// When the user scrolls down 80px from the top of the document, resize the navbar's padding and the logo's font size
window.onscroll = function() {scrollFunction()};

function scrollFunction() {
  if (document.body.scrollTop > 80 || document.documentElement.scrollTop > 80) {
    document.getElementById("navbar").style.padding = "2vw 0.7vw";
    document.getElementById("logo").style.fontSize = "1.5vw";
  } else {
    document.getElementById("navbar").style.padding = "3vw 1vw";
    document.getElementById("logo").style.fontSize = "2.5vw";
  }
}
</script>
<script>
 
function myFunction() {
  var x = document.getElementById("navbar");
  if (x.className === "topnav") {
    x.className += " responsive";
  } else {
    x.className = "topnav";
  }
}
</script>