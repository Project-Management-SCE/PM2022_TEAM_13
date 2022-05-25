<?php

require_once 'core/init.php';


$user = new User();
if(!$user->isLoggedIn()){
	Redirect::to('index.php');
	
}


$pro = new Project($_GET['q']);
$q = $pro->data()->Aid;

$am = new Amuta($q);
$aname = $am->data()->Aname;
$aemail = $am->data()->Aemail;
$amobile =$am->data()->mobileContact;
	?>

<!DOCTYPE html>
<html>
<head>


<link href="https://fonts.googleapis.com/css2?family=Assistant:wght@500;700&display=swap" rel="stylesheet">
<meta name="viewport" content="width=device-width, initial-scale=1">

<script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.1/dist/chart.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">



<script src="https://unpkg.com/resize-observer-polyfill"></script>




<link href="PAA.css" rel="stylesheet">

<style type="text/css">
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
</style>

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
		
	}
	else if($user->hasPermission()=="inv"){

        echo '<a href="PAinvestor.php">אזור אישי</a>';    
    }
	?>	
	<a href="profile.php?user=<?php echo escape($user->data()->username); ?>"> <?php echo escape($user->data()->username); ?>  שלום</a> 
	 <a href="index.php" class="active">דף הבית</a>
  </div> 

</div>	


<div id="main">


<div style="background-color:white;border-radius: 16px;width:65%;height: auto;margin: auto;display: block;">
	<img src="impactlogo.jpeg" alt="FreeLoveLogo"  style="float:left;height: 14vw;width: 14vw;position: relative;left: 5vw;">


<h1 align="right" style="padding-bottom:10vw;font-size:3.5vw;padding-right:25px;position: relative;top: 5vw;" >התקדמות העמותה:  <?php echo $aname;?></h1>
</div>


<br><br>
<div class="tab">
        <button class="tablinks" onclick="openCity(event, 'Raises2')" id="defaultOpen"><strong>גיוסי העמותה</strong></button>
               <button class="tablinks" onclick="openCity(event, 'contact')" ><strong>יצירת קשר</strong></button>

      </div>
      
      <div id="Raises2" class="tabcontent">
	   
        <h1 align="center">הגיוסים שלי</h1>

        <div style="display: block;margin: auto;">
        	<button style="float:right;margin-right:2px;" onclick="myFunction9(<?php echo $q; ?>)" id="mybtn"> רווחים לפי סוג גיוס</button>
					<button style="float:left;" onclick="myFunction1(<?php echo $q; ?>)" id="mybtn2"> רווחי גיוס לאורך זמן</button>

        </div>
		
		
        <div id="wrap" style="overflow-y:auto;">
					<canvas id="mycanvas" ></canvas>			
				</div>
      
				  
		</div>

		<div id="contact" class="tabcontent">
	   
        <h1 align="center">יצירת קשר עם העמותה</h1>

   <div class="card">
  <img src="avatar.png" alt="avatar" style="width:75%">

   <p><button>פרטי עמותה</button></p>
  <div style="margin: 24px 0;">
    <p>שם עמותה: <?php echo $aname; ?> </p>
    <p><?php echo $aemail; ?> :דוא"ל</p>
    <p><?php echo $amobile; ?> :טלפון ליצירת קשר</p>
  </div>
  
</div>
		
		
      </div>

        </div>


 <script src="https://cdnjs.cloudflare.com/ajax/libs/js-polyfills/0.1.43/polyfill.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js/dist/chart.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-adapter-date-fns/dist/chartjs-adapter-date-fns.bundle.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  
 <script type="text/javascript" src="js/lineGraphNew.js"></script>
 <script type="text/javascript" src="js/RaiseBarGraph.js"></script>




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



$(mybtn).on('click',function(){
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
