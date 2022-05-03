<?php

require_once 'core/init.php';
$user = new User();

if($user->isLoggedIn()){
    if($user->data()->assigned==0){
        Redirect::to('userFirstRegister.php');
    }
    if($user->data()->confirmed==0){
        echo "<h1>please activate your account , check your email , if you can't see the email check in spams or contact us</h1><br><a href='logout.php'>התנתק</a>";
        die();
    }

	?>
<!DOCTYPE html>
<html>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="https://fonts.googleapis.com/css2?family=Assistant:wght@500;700&display=swap" rel="stylesheet">
<link href="freeloveStyle.css" rel="stylesheet">
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
	echo '<a href="register.php">רישום משתמשים</a>';
	echo '<a href="register_amuta.php">הוספת עמותות</a>';
	echo '<a href="register_raise.php">הוספת גיוסים</a>';
	echo '<a href="update_raise.php">הזנת איסוף גיוסים</a>';
	echo '<a href="register_project.php">הוספת פרוייקט</a>';
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


<h1 align="right" style="padding-bottom:10vw;font-size:5vw;padding-right:25px;position: relative;top: 5vw;" >ברוכים הבאים</h1>
</div>

<!-- <div  style="position:relative;display:block;margin:auto;"><iframe id="vidframe" src="FILGIF.mp4"   title="Iframe Example"></iframe></div>
 -->
<br><br><br><br><br>
<div id="about" >
<p align="center" style="font-size:24px;">
<strong>impact ?מי אנחנו</strong><br><br>
<ul dir="rtl">
  <li style="font-size:20px;">בית ההשקעות אימפקט הוקם בשנת 2020 , הוא מבתי ההשקעות החדשנים, המקצועיים, המנוסים והאיכותיים בנוף ההשקעות החברתיות בישראל.</li>
  <br><br>
  <li style="font-size:20px;">בית ההשקעות פועל כבוטיק המגיש שירות שלפיתוח פעילויות וגיוס כספים לעמותות לצד שירות ממוקד לקוחות המשקיעים, בעל אופי סולידי וגישה
סובלנית, אך עם יכולות מקצועיות של גוף פיננסי גדול. בכך הוא משלב את הטוב שבכל העולמות
ללא החסרונות שמאפיינים גופים גדולים, תוך נטרול ניגודי עניינים המאפיינים בתי השקעות.</li>
<br><br>
  <li style="font-size:20px;"> אצלנו כל לקוח ולקוח זוכה לטיפול פרטני ונהנה ממלוא ההקשבה  הארגונית של מנהל התיק בהתאם לצרכיו האישיים.  </li>
  <br><br>
  <li style="font-size:20px;"> אימפקט פועל לייצר תשואות עודפות לתיקי ההשקעה של הלקוחות, ברמות סיכון נמוכות ככל שניתן,
תוך שילוב קפדני בין השקעה באפיקים חברתיים ותוך ניצול הזדמנויות בשוק.</li>
<br><br>
<li style="font-size:20px;">  מנהלי ההשקעות מפגינים גמישות ומקצועיות, תוך שימוש במוצרים מורכבים לצד הניהול הסטנדרטי.</li>
<br><br>
<li style="font-size:20px;"> impact מפתחת את סקטור השקעות האימפקט בישראל שצפוי להואיל לכלל אזרחי המדינה  .</li>
<br><br>
</ul>




</p>

</div>
<br><br>
<link href="contact-form.css" rel="stylesheet">

<div class="fcf-body">

    <div id="fcf-form">
    <h1 class="fcf-h3">צרו קשר</h1>

   <form id="fcf-form-id" class="fcf-form-class" method="post" action="mailer.php">
        
        <div class="fcf-form-group">
            <label for="Name" class="fcf-label">שם מלא</label>
            <div class="fcf-input-group">
                <input type="text" id="Name" name="name" class="fcf-form-control" required>
            </div>
        </div>
		<div class="fcf-form-group">
            <label for="Name" class="fcf-label">מספר פלאפון</label>
            <div class="fcf-input-group">
			 
                <input type="tel" id="phone" name="Phone-number"  class="fcf-form-control" required >
            </div>
        </div>

        <div class="fcf-form-group">
            <label for="Email" class="fcf-label">כתובת מייל</label>
            <div class="fcf-input-group">
                <input type="email" id="Email" name="email" class="fcf-form-control" required>
            </div>
        </div>

        <div class="fcf-form-group">
            <label for="Message" class="fcf-label">הודעת טקסט</label>
            <div class="fcf-input-group">
                <textarea id="Message" name="message" class="fcf-form-control" rows="6" maxlength="3000" required></textarea>
            </div>
        </div>

        <div class="fcf-form-group">
            <button type="submit" id="fcf-button" name="submit" class="fcf-btn fcf-btn-primary fcf-btn-lg fcf-btn-block">לחץ לשליחה</button>
        </div>

        

    </form>
    </div>

</div>	
	
</div>		
	
	
	
	</body>
</html>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
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
	<?php 
	
}else {?>
<!DOCTYPE html>
<html>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="https://fonts.googleapis.com/css2?family=Assistant:wght@500;700&display=swap" rel="stylesheet">
<link href="freeloveStyle.css" rel="stylesheet">
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


<h1 align="right" style="padding-bottom:10vw;font-size:5vw;padding-right:25px;position: relative;top: 5vw;" >ברוכים הבאים</h1>
</div>


<!-- <div  style="position:relative;display:block;margin:auto;"><iframe id="vidframe" src="FILGIF.mp4"   title="Iframe Example"></iframe></div> -->

<br><br><br><br><br>
<div id="about" >
<p align="center" style="font-size:24px;">
<strong>impact ?מי אנחנו</strong><br><br>
<ul dir="rtl">
  <li style="font-size:20px;">בית ההשקעות אימפקט הוקם בשנת 2020 , הוא מבתי ההשקעות החדשנים, המקצועיים, המנוסים והאיכותיים בנוף ההשקעות החברתיות בישראל.</li>
  <br><br>
  <li style="font-size:20px;">בית ההשקעות פועל כבוטיק המגיש שירות שלפיתוח פעילויות וגיוס כספים לעמותות לצד שירות ממוקד לקוחות המשקיעים, בעל אופי סולידי וגישה
סובלנית, אך עם יכולות מקצועיות של גוף פיננסי גדול. בכך הוא משלב את הטוב שבכל העולמות
ללא החסרונות שמאפיינים גופים גדולים, תוך נטרול ניגודי עניינים המאפיינים בתי השקעות.</li>
<br><br>
  <li style="font-size:20px;"> אצלנו כל לקוח ולקוח זוכה לטיפול פרטני ונהנה ממלוא ההקשבה  הארגונית של מנהל התיק בהתאם לצרכיו האישיים.  </li>
  <br><br>
  <li style="font-size:20px;"> אימפקט פועל לייצר תשואות עודפות לתיקי ההשקעה של הלקוחות, ברמות סיכון נמוכות ככל שניתן,
תוך שילוב קפדני בין השקעה באפיקים חברתיים ותוך ניצול הזדמנויות בשוק.</li>
<br><br>
<li style="font-size:20px;">  מנהלי ההשקעות מפגינים גמישות ומקצועיות, תוך שימוש במוצרים מורכבים לצד הניהול הסטנדרטי.</li>
<br><br>
<li style="font-size:20px;">  impact מפתחת את סקטור השקעות האימפקט בישראל שצפוי להואיל לכלל אזרחי המדינה  .</li>
<br><br>
</ul>




</p>

</div>
<br><br>
<link href="contact-form.css" rel="stylesheet">

<div class="fcf-body">

    <div id="fcf-form">
    <h1 class="fcf-h3">צרו קשר</h1>

   <form id="fcf-form-id" class="fcf-form-class" method="post" action="mailer.php">
        
        <div class="fcf-form-group">
            <label for="Name" class="fcf-label">שם מלא</label>
            <div class="fcf-input-group">
                <input type="text" id="Name" name="name" class="fcf-form-control" required>
            </div>
        </div>
		<div class="fcf-form-group">
            <label for="Name" class="fcf-label">מספר פלאפון</label>
            <div class="fcf-input-group">
			 
                <input type="tel" id="phone" name="Phone-number"  class="fcf-form-control" required >
            </div>
        </div>

        <div class="fcf-form-group">
            <label for="Email" class="fcf-label">כתובת מייל</label>
            <div class="fcf-input-group">
                <input type="email" id="Email" name="email" class="fcf-form-control" required>
            </div>
        </div>

        <div class="fcf-form-group">
            <label for="Message" class="fcf-label">הודעת טקסט</label>
            <div class="fcf-input-group">
                <textarea id="Message" name="message" class="fcf-form-control" rows="6" maxlength="3000" required></textarea>
            </div>
        </div>

        <div class="fcf-form-group">
            <button type="submit" id="fcf-button" name="submit" class="fcf-btn fcf-btn-primary fcf-btn-lg fcf-btn-block">לחץ לשליחה</button>
        </div>

        

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
<?php 	
}