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

<div class="topnav" id="myTopnav">
  <a href="FreeLoveHomePage.php" class="active">דף הבית</a>
  <a href="#fcf-form">צרו-קשר</a>
  <a href="#about">אודותינו</a>
  <a href="PersonalAreaAss_.php">אזור אישי</a>
  <a href="javascript:void(0);" class="icon" onclick="myFunction()">
    <i class="fa fa-bars"></i>
  </a>
</div>





<br><br><br><br>

<div class="Logo1"><img src="FLIBIG.jpg"  alt="FreeLoveLogo"  style="padding-right:50px;float:right;width:45%;display:block;margin:auto;"></div>


<div  style="position:relative;display:block;margin:auto;"><iframe id="vidframe" src="FILGIF.mp4"   title="Iframe Example"></iframe></div>

<br><br><br><br><br>
<div id="about" >
<p align="center" style="font-size:24px;">
<strong>free love israel ?מי אנחנו</strong><br><br>
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
<li style="font-size:20px;">  Free love israel מפתחת את סקטור השקעות האימפקט בישראל שצפוי להואיל לכלל אזרחי המדינה  .</li>
<br><br>
</ul>




</p>

</div>
<br><br>
<link href="contact-form.css" rel="stylesheet">

<div class="fcf-body">

    <div id="fcf-form">
    <h1 class="fcf-h3">צרו קשר</h1>

   <form id="fcf-form-id" class="fcf-form-class" method="post" action="https://getform.io/f/a2b85382-b8d5-4969-8053-ae62079f0609">
        
        <div class="fcf-form-group">
            <label for="Name" class="fcf-label">שם מלא</label>
            <div class="fcf-input-group">
                <input type="text" id="Name" name="name" class="fcf-form-control" required>
            </div>
        </div>
		<div class="fcf-form-group">
            <label for="Name" class="fcf-label">מספר פלאפון</label>
            <div class="fcf-input-group">
			 
                <input type="tel" id="phone" name="Phone-number"  class="fcf-form-control" required ">
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


</body>
</html>

<script>
 
function myFunction() {
  var x = document.getElementById("myTopnav");
  if (x.className === "topnav") {
    x.className += " responsive";
  } else {
    x.className = "topnav";
  }
}
</script>
