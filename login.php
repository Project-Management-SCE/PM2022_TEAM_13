<?php
require_once 'core/init.php';

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
/* Extra styles for the cancel button */
.cancelbtn {
  width: auto;
  padding: 10px 18px;
  background-color: #f44336;
}

/* Center the image and position the close button */
.imgcontainer {
  text-align: center;
  margin: 24px 0 12px 0;
  position: relative;
}

img.avatar {
  width: 40%;
  border-radius: 50%;
}

.container {
  padding: 16px;
  text-align: right;
}

span.psw {
  float: right;
  padding-top: 16px;
}

/* The Modal (background) */
.modal {
	
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
  padding-top: 12vw;
}

/* Modal Content/Box */
.modal-content {
  background-color:#e6f9ff;
  margin: 5% auto 15% auto; /* 5% from the top, 15% from the bottom and centered */
  border: 1px solid #888;
   border-radius:4px;
  width: 35%; /* Could be more or less, depending on screen size */
}

/* The Close Button (x) */
.close {
  position: absolute;
  right: 25px;
  top: 0;
  color: #000;
  font-size: 35px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: red;
  cursor: pointer;
}

/* Add Zoom Animation */
.animate {
  -webkit-animation: animatezoom 0.6s;
  animation: animatezoom 0.6s
}

@-webkit-keyframes animatezoom {
  from {-webkit-transform: scale(0)} 
  to {-webkit-transform: scale(1)}
}
  
@keyframes animatezoom {
  from {transform: scale(0)} 
  to {transform: scale(1)}
}

/* Change styles for span and cancel button on extra small screens */
@media screen and (max-width: 300px) {
  span.psw {
     display: block;
     float: none;
  }
  .cancelbtn {
     width: 100%;
  }
}
input[type=text] {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  box-sizing: border-box;
  direction:rtl;
}

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
<div class="fcf-body">
	<div id="fcf-form">
		<h1 class="fcf-h3">התחברות</h1>
<?php
if(Input::exists()){
	if(Token::check(Input::get('token'))){
		$validate = new Validate();
		$validation = $validate->check($_POST,array(
			'username'=>array('required' =>true),
			'password'=>array('required' =>true)
		));
		if ($validation->passed()){
			$user =new User();
			
			$remember = (Input::get('remember') === 'on') ? true : false;
			$login = $user->login(Input::get('username'),Input::get('password'),$remember);
			
			if($login){
				Redirect::to('index.php');
				
			}else{
				echo '<br>login failed<br>';
				
			}
			
		}else{
			foreach($validation->errors() as $error){
				echo '<p align="left">'.$error . '</p>';
				
			}
			
		}
	}
	
}


?>


		<form id="fcf-form-id" class="fcf-form-class" action="" method="post">
			<div class="fcf-form-group">
				<label class="fcf-label" for="username">שם משתמש</label>
				<div class="fcf-input-group">
					<input type="text" class="fcf-form-control" name="username" id="username" value="<?php echo escape(Input::get('username'));  ?>" autocomplete="off">
				</div>
			</div>
			<div class="fcf-form-group">
				<label class="fcf-label" for="password">סיסמא</label>
				<div class="fcf-input-group">
					<input type="password" class="fcf-form-control" name="password" id="password" value="" autocomplete="off">
				</div>
			</div>
			<div class="fcf-form-group">
				<label class="fcf-label" for="remember">
				<input type="checkbox" name="remember" id="remember">זכור אותי
				</label>
				
			</div>
			
			<input type="submit" value="התחבר" class="fcf-btn fcf-btn-primary fcf-btn-lg fcf-btn-block">
			<input type="hidden" name="token" value="<?php echo Token::generate();?>">
			
			</form>	
	</div>
</div>
</div>
</body>
</html>
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