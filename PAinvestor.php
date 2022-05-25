<?php

require_once 'core/init.php';


$user = new User();
if(!$user->isLoggedIn()){
	Redirect::to('index.php');
	
}

$inv = $user->data()->username;
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


<div id="main">


<div style="background-color:white;border-radius: 16px;width:65%;height: auto;margin: auto;display: block;">
	<img src="impactlogo.jpeg" alt="FreeLoveLogo"  style="float:left;height: 16vw;width: 16vw;position: relative;left: 5vw;">


<h1 align="right" style="padding-bottom:10vw;font-size:5vw;padding-right:25px;position: relative;top: 5vw;" >אזור אישי משקיעים</h1>
</div>


<br><br>
<div class="tab">
			  <button class="tablinks" onclick="openCity(event, 'MyPro');" id="defaultOpen"><strong>השקעות שלי</strong></button>
        <button class="tablinks" onclick="openCity(event, 'Raises2')" ><strong>השקעות</strong></button>
        <button class="tablinks" onclick="openCity(event, 'MyAcc')"><strong>מצב חשבון</strong></button>
      </div>
      
      <div id="Raises2" class="tabcontent">
	   
        <h1 align="center">השקעות</h1>
		
	
		
		
      </div>
	  
	 
      
      <div id="MyAcc"  class="tabcontent">
        <h1 align="center">מצב חשבון</h1>
        <div>
          <button style="float:left;" id="mybtn2"onclick="myFunction1('<?php echo $inv; ?>')">ציר השקעות</button>
        <button style="float:right;" id="mybtn3" onclick="document.getElementById('id02').style.display='block';document.getElementById('amount').readOnly=false;document.getElementById('Invid').type='hidden'">הפקדת כסף</button>
        <button style="float:right;" id="mybtn1" onclick="myFunction2('<?php echo $inv; ?>')">מצב חשבון</button>

        </div>
		    
    <div id="id02" class="modal" >
    
    <form id="Cform2" class="modal-content animate" action="PayInv.php" method="post" > 
      
      
        <div class="imgcontainer">
          <span onclick="document.getElementById('id02').style.display='none';document.getElementById('amount').readOnly=true;document.getElementById('Invid').type='text'" class="close" title="Close Modal">&times;</span>
         
        </div>

        <div class="container">
          <label for="Inivid">מספר השקעה</label><br>
          <input type="text" id="Invid" name="Invid" readonly><br>
          <label for="amount">סכום לתשלום</label><br>
          <input type="text" id="amount" name="amount" readonly><br>
            <button type="submit" name="pay">לתשלום מאובטח</button>    
            </div>
          
        <div class="container" style="background-color:#00ace6">
          <button type="button" onclick="document.getElementById('id02').style.display='none';document.getElementById('amount').readOnly=true;document.getElementById('Invid').type='text'" class="cancelbtn">Cancel</button>
        </div>
        </form>
        </div>
				<br><br>
						
        <div id="wrap">
        <canvas id="mycanvas" ></canvas>      
      </div>

	   		</div>
     


      <div id="MyPro" class="tabcontent">
        <h1 align="center">השקעות שלי</h1>

        <div id="id01" class="modal" >
    
    <form id="Cform1" class="modal-content animate" action="InvestConfirm.php" method="post" > 
      
      
        <div class="imgcontainer">
          <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
         
        </div>

        <div class="container">
          
          <label for="Inivid2">מספר השקעה</label><br>
          <input type="text" id="Invid2" name="Invid2" readonly><br>
          
           <label for="amount2">סכום לתשלום</label><br>
          <input type="text" id="amount2" name="amount2" readonly><br>
              

          <button id="other" name="other" type="submit">אשר השקעה ושלם דרך אמצעי תשלום אחר</button>

            <button id="credit" name="credit" type="button" onclick="document.getElementById('id01').style.display='none';document.getElementById('id02').style.display='block';document.getElementById('Invid').value=document.getElementById('Invid2').value;openCity(event, 'MyAcc');document.getElementById('amount').value=document.getElementById('amount2').value;">אשר השקעה ושלם באשראי</button>    
            </div>
          
        <div class="container" style="background-color:#00ace6">
          <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
        </div>
        </form>
        </div>
   
      </div>
      
      
				  
		</div>

 <script src="https://cdnjs.cloudflare.com/ajax/libs/js-polyfills/0.1.43/polyfill.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js/dist/chart.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-adapter-date-fns/dist/chartjs-adapter-date-fns.bundle.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  
<script type="text/javascript" src="js/getAllProjects.js"></script>
<script type="text/javascript" src="js/getinvests.js"></script>
<script type="text/javascript">document.addEventListener('DOMContentLoaded', getInvests('<?php echo $inv; ?>'));</script>
<script type="text/javascript" src="js/LinegraphAtest.js"></script>
<script type="text/javascript" src="js/InvestTable.js"></script>
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
