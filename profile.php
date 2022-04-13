<?php

require_once 'core/init.php';



if(!$username=Input::get('user')){
	Redirect::to('index.php');
	
}else{
	$user = new User($username);
	if(!$user->exists()){
		Redirect::to(404);
	}else{
		$data = $user->data();
		
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

.card {
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
  max-width: 400px;
  margin: auto;
  text-align: center;
  font-family: arial;
  background-color:white;
}

.title {
  color: grey;
  font-size: 18px;
}

button {
  border: none;
  outline: 0;
  display: inline-block;
  padding: 8px;
  color: white;
  background-color: #000;
  text-align: center;
  cursor: pointer;
 
  font-size: 18px;
}

a {
  text-decoration: none;
  font-size: 22px;
  color: black;
}

button:hover, a:hover {
  opacity: 0.7;
}
button:hover {
  opacity: 0.8;
}

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
  left: 25px;
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

<div id="navbar" class="topnav">
 <a href="#default" id="logo">free love israel</a>
	<div id="navbar-right">
	
    <a href="javascript:void(0);" class="icon" onclick="myFunction()">
    <i class="fa fa-bars"></i></a>
	<a href="logout.php">התנתק</a>
	 <a href="changepassword.php">שנה סיסמא</a>
	<a href="update.php">עדכון פרטים</a>
	 <?php  if($user->hasPermission()=="ass"){
		echo '<a href="PersonalAreaAss_.php">אזור אישי</a>';
		
	}?>	
	<a href="profile.php?user=<?php echo escape($user->data()->username); ?>"> <?php echo escape($user->data()->username); ?>  שלום</a> 
	 <a href="index.php" class="active">דף הבית</a>
  </div> 



<?php
if($user->hasPermission()=="admin"){
echo '<button class="openbtn" onclick="openNav()">☰</button>';
}
?>	
</div>	
<?php  
$am = new Amuta(escape($user->data()->username));
$Adata = $am->data();
if(isset($_SESSION['profile'])){echo $_SESSION['profile'];}
?>
<?php
if($user->hasPermission()=="admin"){
	echo '<div id="mySidebar" class="sidebar">';
	echo '<a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>';
	echo '<a href="register.php">רישום משתמשים</a>';
	echo '<a href="register_amuta.php">הוספת עמותות</a>';
	echo '<a href="register_raise.php">הוספת גיוסים</a>';
	echo '<a href="update_raise.php">הזנת איסוף גיוסים</a>';
	echo '<a href="register_project.php">הוסף פרוייקט</a>';
	echo '</div>';
}
?>
<div id="main">
<?php
if($user->hasPermission()=='admin'){
echo '<button class="openbtn" onclick="openNav()">☰</button>';
}
?>	
<div class="card">
  <img src="avatar.png" alt="avatar" style="width:75%">
  <h1><?php echo escape($data->username); ?></h1>
  <p ><?php echo escape($data->first_name).' '.escape($data->last_name); ?> :שם מלא</p>
  <p><?php echo escape($data->email); ?> :דוא"ל</p>
 <?php if($user->hasPermission()=='admin'){echo "<p><button>מנהל האתר</button></p>";}
  if($user->hasPermission()=='ass'){
 	?>

   <p><button>פרטי עמותה</button></p>
  <div style="margin: 24px 0;">
    <p>שם עמותה: <?php echo escape($Adata->Aname); ?> </p>
    <p><?php echo escape($Adata->Anumber); ?> :מספר עמותה</p>
    <p><?php echo escape($Adata->Aemail); ?> :דוא"ל</p>
    <p><?php echo escape($Adata->mobileContact); ?> :טלפון ליצירת קשר</p>
	<p><?php echo escape($Adata->Target); ?> :יעד גיוסים</p>
	<p><?php echo escape($Adata->TargetStart); ?> :תאריך תחילת פרוייקט</p>
	<p><?php echo escape($Adata->TargetEnd); ?> :תאריך  סיום פרוייקט</p>
  </div>
  <p><button onclick="document.getElementById('id01').style.display='block'">עדכון פרטי עמותה</button></p>
</div>
 <div id="id01" class="modal">
				
			
			
			  <form id="Cform" class="modal-content animate" action="" method="post">
			  
			  	<?php if(Input::exists()){
						if(Token::check(Input::get('token'))){
							$validate = new Validate();
							$validation = $validate->check($_POST,array(
								'Aemail'=>array('required' =>true),
								'mobileContact'=>array('required' =>true,'numeric' =>true)
							));
							if ($validation->passed()){
								
								$update = $am->update(array(
									'Aemail'=>Input::get('Aemail'),
									'mobileContact'=>Input::get('mobileContact')));
								
								if($update){
									Session::flash('profile','your details have been updated!');
									Redirect::to('profile.php?user='.escape($user->data()->username));
									
								}else{
									Session::flash('profile','problem updating!');
									Redirect::to('profile.php?user='.escape($user->data()->username));
									
								}
								
							}else{
								foreach($validation->errors() as $error){
									echo '<p align="left">'.$error . '</p>';
									
								}
								
							}
						}
	
}?>
			
				<div class="imgcontainer">
				  <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
				 
				</div>

				<div class="container">
					 <p>על מנת לשנות פרטים אחרים צור קשר עם צוות האתר</p>
					 <label for="Aemail">דואר אלקטרוני</i>
					  </label>
					  <input type="text" id="Aemail" name="Aemail"  value="<?php echo escape($Adata->Aemail);  ?>"  autocomplete="off"><br> 
						
						<label for="mobileContact">מספר נייד</i>
					  </label>
					  <input type="text" id="mobileContact" name="mobileContact"  value="<?php echo escape($Adata->mobileContact);  ?>"  autocomplete="off"><br>
					 
					 
					
				  <button id ="btn4" type="submit">שנה פרטים</button>

				</div>

				<div class="container" style="background-color:#00ace6">
				  <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
				</div>
				<input type="hidden" name="token" value="<?php echo Token::generate();?>">
			  </form>
			</div>	
	
	<?php
}

?>
	<?php

	
}?>

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
// Get the modal
var modal = document.getElementById('id01');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
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

