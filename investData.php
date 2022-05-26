
<?php
require_once 'core/init.php';
include 'invfileslogic.php';
$user = new User();
if(!$user->isLoggedIn()|| !$user->hasPermission()=="admin"){
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
input{
  padding:0.7vw 0.3vw; 
  font-size: 1.1vw;
  font-family: 'Assistant', sans-serif;
  background-color:#7b97ea;
  text-align: center; 
   direction: rtl;
   border-radius: 4px;

}
button{
padding:0.4vw 0.3vw;
  font-size: 1.1vw;
  font-family: 'Assistant', sans-serif;
  background-color:#7b97ea;
  text-align: center; 
   border-radius: 4px;
   cursor: pointer;
}

/*@media screen and (max-width: 600px) {

	input{
  padding: 1.5vw;
  font-size: 1.9vw;

}
button{
	padding: 1.5vw;
  font-size: 1.9vw;

}

}*/
/* Extra styles for the cancel button */
.cancelbtn {
  width: auto;
  padding: 10px 18px;
  background-color: #4b84e7;
  border-radius:2vw;
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
  }else if($user->hasPermission()=="inv"){

        echo '<a href="PAinvestor.php">אזור אישי</a>';    
    }
    ?>  
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
     echo '<div class="dropdown">';
    echo '<button onclick="drpfunc(4)" class="dropbtn">השקעות</button>';
    echo'<div id="myDropdown4" class="dropdown-content">';
     echo '<a href="investAproove.php">אישור השקעות</a>';
    echo '<a href="downloadsinv.php">ניהול קבצי השקעות</a>';
    echo '<a href="investData.php">השקעות</a>';
    echo '</div>';
    echo '</div>'; 

    echo '<a href="PAA_admin.php">אזור אישי עמותות</a>';
    echo '<a href="PAI_Admin.php">אזור אישי משקיעים</a>';
      echo '<a href="Requests.php">בקשות משיכת כספים</a>';

  echo '</div>';
}
?>

<div id="main">
<?php
if($user->hasPermission()=="admin"){
echo '<button class="openbtn" onclick="openNav()">☰</button>';
}
?>  

  <div id="id02" class="modal" >
    
    <form id="Cform2" class="modal-content animate" action="investAssign.php" method="post" > 
      
      
        <div class="imgcontainer">
          <span onclick="document.getElementById('id02').style.display='none'" class="close" title="Close Modal">&times;</span>
         
        </div>

        <div class="container">
          <label for="Inivid">מספר השקעה</label><br>
          <input type="text" id="Invid2" name="Invid2" readonly><br>
            <button type="submit" name="save">השקעה החוזרה</button>    
            </div>
          
        <div class="container" style="background-color:#00ace6">
          <button type="button" onclick="document.getElementById('id02').style.display='none'" class="cancelbtn">Cancel</button>
        </div>
        </form>
        </div>

				
			</div>

  </body>
</html>
<script type="text/javascript" src="js/investData.js"></script>

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