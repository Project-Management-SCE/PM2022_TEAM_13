<?php

require_once 'core/init.php';


if(isset($_GET['Investor'])){
	$inv= new Invest($_GET['Investor']);
	$invID = $_GET['Investor'];
}
$user = new User();
if(!$user->isLoggedIn()){
	Redirect::to('index.php');
	
}
	?>

<!DOCTYPE html>
<html>
<head>


<link href="https://fonts.googleapis.com/css2?family=Assistant:wght@500;700&display=swap" rel="stylesheet">
<meta name="viewport" content="width=device-width, initial-scale=1">

<script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.1/dist/chart.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<link href="contact-form.css" rel="stylesheet">

<script src="https://unpkg.com/resize-observer-polyfill"></script>




<link href="PAA.css" rel="stylesheet">



</head>




<body>
<!-- <div id="loader" class="center"></div> -->
<div id="navbar" class="topnav">
 <a href="#default" id="logo"><img style="position: absolute;top: 2.5vw;height: 4vw;width: 4vw;" src="impactlogo.jpeg" alt="FreeLoveLogo"></a>
	<div id="navbar-right">
	
    <a href="javascript:void(0);" class="icon"  onclick="myFunction()">
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



<div style="background-color:white;border-radius: 16px;width:65%;height: auto;margin: auto;display: block;">
	<img src="impactlogo.jpeg" alt="FreeLoveLogo"  style="float:left;height: 16vw;width: 16vw;position: relative;left: 5vw;">


<h1 align="right" style="padding-bottom:10vw;font-size:5vw;padding-right:25px;position: relative;top: 5vw;" >אזור אישי משקיעים</h1>
</div>
<?php 
if(!isset($_GET['Investor'])){
?>
<div style="display: block;margin: auto;width: 20vw;">
	<select name="username" id="username" class="fcf-form-control" onchange="findinv(''+this.value)" >
						<option value=" ">בחר משקיע</option>
						
					  
							  <?php 

									require_once "connectionoop.php";

									$query1 = sprintf("SELECT DISTINCT investor FROM invests WHERE 1");
									//execute query
									$result1 = $mysqli->query($query1);

									//loop through the returned data
									
									foreach ($result1 as $data) {
									  echo "<option value='". $data['investor'] ."'>" .$data['investor']."</option>";  // displaying data in option menu
									}
						?>  
					  
					  
					  </select>
</div>

<?php }else{ ?>

<button onclick='window.location.href="PAI_Admin.php";' style="display: block;margin: auto;border-radius: 4px;width:auto;font-size: 32px; color:white;background-color: #4b84e7;">החלף משקיע</button>

<?php
}
?>
<?php 
if(isset($_GET['Investor'])){
	?>
<br><br>

<div class="tab">
			  <button class="tablinks" onclick="openCity(event, 'MyPro')" id="defaultOpen"><strong>השקעות שלי</strong></button>
        <button class="tablinks" onclick="openCity(event, 'MyAcc')"><strong>מצב חשבון</strong></button>
      </div>
      
      
	  
	 
      
      <div id="MyAcc"  class="tabcontent">
        <h1 align="center">מצב חשבון</h1>
		    <button style="float:left;" id="mybtn2" onclick="myFunction1('<?php echo $_GET['Investor']; ?>')">ציר השקעות</button>
        <button style="float:right;" id="mybtn1" onclick="myFunction2('<?php echo $_GET['Investor']; ?>')">מצב חשבון</button>

				
						
        <div id="wrap" style="overflow-y:auto;">
        <canvas id="mycanvas" ></canvas>      
      </div>

	   		</div>
     


      <div id="MyPro" class="tabcontent">
        <h1 align="center">השקעות שלי</h1>
   
      </div>


      <script type="text/javascript">

      	function openCity(evt, cityName) {
        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
          tabcontent[i].style.display = "none";
        }
        tablinks = document.getElementsByClassName("tablinks");
        for (i = 0; i < tablinks.length; i++) {
          tablinks[i].className = tablinks[i].className.replace(" active", "");
        }
        document.getElementById(cityName).style.display = "block";
        evt.currentTarget.className += " active";
      }
      
      // Get the element with id="defaultOpen" and click on it
      document.getElementById("defaultOpen").click();
      </script>
     <?php }?> 
      
				  
		</div>

 <script src="https://cdnjs.cloudflare.com/ajax/libs/js-polyfills/0.1.43/polyfill.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js/dist/chart.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-adapter-date-fns/dist/chartjs-adapter-date-fns.bundle.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  

<script type="text/javascript" src="js/getinvests.js"></script>
<?php if(isset($_GET['Investor'])){ ?>
<script type="text/javascript">document.addEventListener('DOMContentLoaded', getInvests('<?php echo $_GET['Investor']; ?>'));</script>
<?php }?>
<script type="text/javascript" src="js/LinegraphAtest.js"></script>
<script type="text/javascript" src="js/InvestTable.js"></script>
<script type="text/javascript" src="js/PAI_admin.js"></script>

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
function openCity(evt, cityName) {
        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
          tabcontent[i].style.display = "none";
        }
        tablinks = document.getElementsByClassName("tablinks");
        for (i = 0; i < tablinks.length; i++) {
          tablinks[i].className = tablinks[i].className.replace(" active", "");
        }
        document.getElementById(cityName).style.display = "block";
        evt.currentTarget.className += " active";
      }
      
      // Get the element with id="defaultOpen" and click on it
      document.getElementById("defaultOpen").click();


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

$('body').append('<div style="position:fixed;top:1vw;" class="center" id="loader"></div>');
$(window).on('load', function(){
  setTimeout(removeLoader, 1000); //wait for page load PLUS two seconds.
});
function removeLoader(){
    $( "#loader" ).fadeOut(500, function() {
      // fadeOut complete. Remove the loading div
      $( "#loader" ).remove(); //makes page more lightweight 
  });  
}

$(mybtn1).on('click',function(){
  $('body').append('<div style="position:fixed;top:1vw;" class="center" id="loader"></div>');
  setTimeout(removeLoader, 1000);

});

$(mybtn2).on('click',function(){
  $('body').append('<div style="position:fixed;top:1vw;" class="center" id="loader"></div>');
  setTimeout(removeLoader, 1000);

});


    </script>
</body>
</html> 
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
</body>
</html> 
