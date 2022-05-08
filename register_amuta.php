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
    <h1 class="fcf-h3">הוסף עמותה</h1>
	
	<?php
	if(Input::exists()){
	if(Token::check(Input::get('token'))){
	$validate =new Validate();
	$validation = $validate->check($_POST, array(
		'username'=>array(
			'required'=>true,
			'exists'=>'users'	
		),
		'Anumber'=>array(
			'required'=>true,
			'numeric'=>true,
			'unique'=>'association'
		),
		'Aname'=>array(
			'required'=>true,
			'min'=>2,
			'max'=>80
		),
		'Aemail'=>array(
			'required'=>true,
			'min'=>2,
			'max'=>80
		),
		
		'TargetStart'=>array(
			'required'=>true
		),
		'TargetEnd'=>array(
			'required'=>true
		),
		'mobileContact'=>array(
			'required'=>true,
			'numeric'=>true
		)
	));
	
	if($validation->passed()){
		Session::flash('success','You registered successfully!');
		$amut= new Amuta();
		try{
			$amut->create(array(
				'username' =>Input::get('username'),
				'Aemail' =>Input::get('Aemail'),
				'Aname' =>Input::get('Aname'),
				'Anumber' =>Input::get('Anumber'),
				'TargetStart' =>Input::get('TargetStart'),
				'TargetEnd' =>Input::get('TargetEnd'),
				'mobileContact'=>Input::get('mobileContact')
			));
			
			Session::flash('home','you have added the association !');
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
					<select id="f4" name="username" id="username" class="fcf-form-control" >
						<option value=" ">select a user</option>
						
					  
							  <?php 

							  require_once "connectionoop.php";

									$query1 = sprintf("SELECT  username,first_name,last_name,email FROM users WHERE 1");
									//execute query
									$result1 = $mysqli->query($query1);

									//loop through the returned data
									
									foreach ($result1 as $data) {
									 echo "<option value='". $data['username'] ."'>" .$data['first_name']."-".$data['last_name']."-".$data['email']."</option>";  // displaying data in option menu
									}

						?>  
					  
					  </select>
				</div>
			</div>
			<div class="fcf-form-group">
				<label class="fcf-label" for="Aemail">דואר אלקטרוני</label>
				<div class="fcf-input-group">	
					<input type="text" class="fcf-form-control" name="Aemail" id="Aemail" value="<?php echo escape(Input::get('Aemail'));  ?>" autocomplete="off">
				</div>	
			</div>
			<div class="fcf-form-group">
				<label class="fcf-label" for="mobileContact">טלפון ליצירת קשר</label>
				<div class="fcf-input-group">	
					<input type="text" class="fcf-form-control" name="mobileContact" id="mobileContact" value="<?php echo escape(Input::get('mobileContact'));  ?>" autocomplete="off">
				</div>	
			</div>
			<div class="fcf-form-group">
				<label class="fcf-label" for="Aname">שם עמותה</label>
				<div class="fcf-input-group">
					<input type="text" class="fcf-form-control" name="Aname" id="Aname" value="<?php echo escape(Input::get('Aname'));  ?>" autocomplete="off">
				</div>
			</div>
			<div class="fcf-form-group">
				<label class="fcf-label" for="Anumber">מספר עמותה</label>
				<div class="fcf-input-group">	
					<input type="text" class="fcf-form-control" name="Anumber" id="Anumber" value="<?php echo escape(Input::get('Anumber'));  ?>" autocomplete="off">
				</div>
			</div>
			
			
			<div class="fcf-form-group">
				<label class="fcf-label" for="TargetStart">תאריך תחילת תוכנית</label>
				<div class="fcf-input-group">	
					<input type="date" class="fcf-form-control" name="TargetStart" id="TargetStart" value="<?php echo escape(Input::get('TargetStart'));  ?>" autocomplete="off">
				</div>
			</div>
			<div class="fcf-form-group">
				<label class="fcf-label" for="TargetEnd">תאריך סיום תוכנית</label>
				<div class="fcf-input-group">
					<input type="date" class="fcf-form-control" name="TargetEnd" id="TargetEnd" value="<?php echo escape(Input::get('TargetEnd'));  ?>" autocomplete="off">
				</div>
			</div>
			<input type="submit" class="fcf-btn fcf-btn-primary fcf-btn-lg fcf-btn-block" value="צור עמותה">
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