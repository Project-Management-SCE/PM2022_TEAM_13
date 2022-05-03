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
  background-color: #4b84e7;
  border-radius:2vw;
  cursor:pointer;
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
  position: relative;
  left:250px;
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
#btn4,#mybtn3{
	background-color: #4b84e7;
	 border-radius:5vw;
	 color:white;
	 padding: 0.5vw 0.7vw;
	 font-family: 'Assistant', sans-serif;
	  font-size: 2vw;
  transition: 0.3s;	  
	  z-index:99;
  cursor:pointer;
  margin:2vw;
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

<?php
if(Input::exists()){
	if(Token::check(Input::get('token'))){
		$validate = new Validate();
		$validation = $validate->check($_POST,array(
			'Email'=>array('required' =>true,'exists'=>'users')
		));
		if ($validation->passed()){
			$m = new Mailer();
			$m->ResetPassword(Input::get('Email'));
			Redirect::to('index.php');
			
			
		}else{
			foreach($validation->errors() as $error){
				echo '<p align="left">'.$error . '</p>';
				
			}
			
		}
	}
	
}


?>
<button onclick="document.getElementById('id01').style.display='block'" style="border-radius: 4px;width:auto;font-size: 24px; color:black;display: block;margin: auto;background-color: #4b84e7;" id="mybtn3">שכחתי סיסמא</button>
<div id="id01" class="modal">
	
			  <form id="Cform" class="modal-content animate" action="" method="post">
			  
			  	
			
				<div class="imgcontainer">
				  <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
				 
				</div>

				<div class="container">
					  <label for="Email">אימייל של מתשמש הרשום במערכת
					  </label>
					  <input type="text" id="Email" name="Email"  value="<?php echo escape(Input::get('Email'));  ?>"  autocomplete="off"><br>
					 
					 
				  <button id ="btn4" type="submit">אפס סיסמא</button>

				</div>

				<div class="container" style="background-color:#00ace6">
				  <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
				</div>
				<input type="hidden" name="token" value="<?php echo Token::generate();?>">
			  </form>
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