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

<div id="navbar" class="topnav">
  <a href="#default" id="logo"><img style="position: absolute;top: 2.5vw;height: 4vw;width: 4vw;" src="impactlogo.jpeg" alt="FreeLoveLogo"></a>
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

</div>	
<?php
if($user->hasPermission()=="admin"){
	echo '<div id="mySidebar" class="sidebar">';
	echo '<a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>';
	echo '<div class="dropdown">';
    echo '<button onclick="drpfunc(1)" class="dropbtn">הרשמה</button>';
    echo'<div id="myDropdown1" class="dropdown-content">';
    echo '<a href="register.php">הרשמת משתמשים</a>';
    echo '<a href="register_amuta.php">הוספת עמותות</a>';
    echo '<a href="register_raise.php">הוספת גיוסים</a>';
    echo '<a href="register_project.php">הוספת פרוייקט</a>';
    echo '</div>';
    echo '</div>';
    echo '<div class="dropdown">';
    echo '<button onclick="drpfunc(2)" class="dropbtn">עמותות</button>';
    echo'<div id="myDropdown2" class="dropdown-content">';
    echo '<a href="update_raise.php">הזנת איסוף גיוסים</a>';
    echo '<a href="generalData.php">ניהול  פרוייקטים וגיוסים</a>';
    echo '<a href="UsersData.php">ניהול משתמשים ועמותות</a>';
    echo '</div>';
    echo '</div>';
     echo '<div class="dropdown">';
    echo '<button onclick="drpfunc(3)" class="dropbtn">פרוייקטים</button>';
    echo'<div id="myDropdown3" class="dropdown-content">';
     echo '<a href="projectFiles.php">העלאת קבצי פרוייקט</a>';
    echo '<a href="downloads.php">ניהול קבצי פרוייקט</a>';
    echo '<a href="generalData.php">ניהול  פרוייקטים וגיוסים</a>';
    echo '</div>';
    echo '</div>'; 
    echo '<a href="PAA_admin.php">אזור אישי עמותות</a>';
	echo '</div>';
}
?>

<div id="main">
<?php
if($user->hasPermission()=="admin"){
echo '<button class="openbtn" onclick="openNav()">☰</button>';
}
?>	
<div class="fcf-body">

    <div id="fcf-form">
    <h1 class="fcf-h3">שינוי פרטים</h1>
	
	
<?php



if(Input::exists2('post','Email')){

		$evalidate = new Validate();
		
		$evalidation = $evalidate->check($_POST, array('Email'=>array(
			'required'=>true,
			'unique'=>'users'	
		)));
		if($evalidation->passed()){
			try{
				$user -> update(array(
					'Email'=>Input::get('Email')
				));
				Session::flash('update','your details have been updated!');
				Redirect::to('update.php');
			}catch(Exception $e){
				die($e->getMessage());
			}
		
	}else{
		foreach($evalidation->errors() as $error){
			echo '<p align="left">'.$error . '</p>';
			
			
		}	
			
	}	
}
	
	
	else if(Input::exists2('post','username')){
		$uvalidate = new Validate();
		
		$uvalidation = $uvalidate->check($_POST, array(
			'username'=>array(
			'required'=>true,
			'min'=>3,
			'max'=>25,
			'unique'=>'users'
		)));
		if($uvalidation->passed()){
			try{
				
				$user -> update(array(
					'username'=>Input::get('username')
				));
				Session::flash('update','your details have been updated!');
				Redirect::to('update.php');
			}catch(Exception $e){
				die($e->getMessage());
			}
		
		
	}else{
		foreach($uvalidation->errors() as $error){
			echo '<p align="left">'.$error . '</p>';
			
			
		}	
			
	}
	}	
	
	
	
	
	
	else if(Input::exists2('post','first_name')){
	
		$fvalidate = new Validate();
		
		$fvalidation = $fvalidate->check($_POST, array(
			'first_name'=>array(
			'required'=>true,
			'min'=>2,
			'max'=>50
		)));
		if($fvalidation->passed()){
			try{
				$user -> update(array(
					'first_name'=>Input::get('first_name')
				));
				
				Session::flash('update','your details have been updated!');
				Redirect::to('update.php');
			}catch(Exception $e){
				die($e->getMessage());
			}
		
	}else{
		foreach($fvalidation->errors() as $error){
			echo '<p align="left">'.$error . '</p>';
			
			
		}	
			
	}	
	}
	
	else if(Input::exists2('post','last_name')){
	
		$lvalidate = new Validate();
		
		$lvalidation = $lvalidate->check($_POST, array(
			'last_name'=>array(
			'required'=>true,
			'min'=>3,
			'max'=>50
		)));
		if($lvalidation->passed()){
			try{
				$user -> update(array(
					'last_name'=>Input::get('last_name')
				));
				
				Session::flash('update','your details have been updated!');
				Redirect::to('update.php');
			}catch(Exception $e){
				die($e->getMessage());
			}
		
	}else{
		foreach($lvalidation->errors() as $error){
			echo '<p align="left">'.$error . '</p>';
			
			
		}	
			
	}	
	
	
	
		
	
		
	}
	


?>	
<form action="" method="post">
	<div class="field">
		<input type="text" class="fcf-form-control" name="Email" id="Email" value="<?php echo escape($user->data()->email);  ?>" autocomplete="off">
				<label for="Email"> <input type="submit" class="fcf-btn fcf-btn-primary fcf-btn-lg fcf-btn-block" value="Update Email"></label>

	</div>
	
	
	
	</form>	
	
	
	<form action="" method="post">
	<div class="field">
		<input type="text" class="fcf-form-control" name="username" id="username" value="<?php echo escape($user->data()->username);  ?>" autocomplete="off">
				<label for="username"><input type="submit" class="fcf-btn fcf-btn-primary fcf-btn-lg fcf-btn-block" value="Update UserName"></label>

	</div>
	
	
	
	
	</form>	
	
	
	
	<form action="" method="post">
	
	<div class="field">
		<input type="text" class="fcf-form-control" name="last_name" id="last_name" value="<?php echo escape($user->data()->last_name);  ?>" autocomplete="off">
		<label for="last_name"><input type="submit" class="fcf-btn fcf-btn-primary fcf-btn-lg fcf-btn-block" value="Update Last Name"></label>

	</div>
	
	
	
	
	</form>	
	
	<form action="" method="post">
	
	<div class="field">
		<input type="text" class="fcf-form-control" name="first_name" id="first_name" value="<?php echo escape($user->data()->first_name);  ?>" autocomplete="off">
		<label for="first_name"><input type="submit" class="fcf-btn fcf-btn-primary fcf-btn-lg fcf-btn-block" value="Update First Name"></label>

	</div>
	
	
	
	
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

<script>
/* When the user clicks on the button, 
toggle between hiding and showing the dropdown content */
function drpfunc(val) {
  document.getElementById("myDropdown"+val).classList.toggle("show");
}

// Close the dropdown if the user clicks outside of it
window.onclick = function(event) {
  if (!event.target.matches('.dropbtn')) {
    var dropdowns = document.getElementsByClassName("dropdown-content");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}
</script>