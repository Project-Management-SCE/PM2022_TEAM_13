<?php

require_once 'core/init.php';
$email=$_GET['key'];
$user = new User();
$user->find5($email);


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
<div class="fcf-body">
  <div id="fcf-form">
    <h1 class="fcf-h3">שינוי סיסמא</h1>

<?php
if(Input::exists2('post','password')){
  
  if(Token::check(Input::get('token'))){
    $pvalidate = new Validate();
    
    $pvalidation = $pvalidate->check($_POST, array(
      'password'=>array(
        'required'=>true,
        'min'=>6
      ),
      'password_again'=>array(
        'required'=>true,
        'matches'=>'password'
        
      )
      ));
    if($pvalidation->passed()){
      
        $salt = Hash::salt(32);
        $user -> update(array(
          'password'=>Hash::make(Input::get('password'),$salt),
          'salt'=>$salt
        ),$user ->data()->id);
        Session::flash('updatepass','your details have been updated!');
        Redirect::to('index.php');
      
      
    }else{
      foreach($pvalidation->errors() as $error){
        echo '<p align="left">'.$error . '</p>';
        
        
      } 
        
    }
    
  }
      
}
  

?>
  
      <form action="" class="fcf-form-class" method="post">
      
      <div class="fcf-form-group">
        <label for="password">סיסמא חדשה</label>
        <div class="fcf-input-group">
          <input type="password" class="fcf-form-control" name="password" id="password" value="" autocomplete="off">
        </div>
      </div>
      
        
      
      <div class="fcf-form-group">
        <label for="password_again">אימות סיסמא</label>
        <div class="fcf-input-group"> 
          <input type="password" class="fcf-form-control" name="password_again" id="password_again" value="" autocomplete="off">
        </div>
      </div>
      
      
      
      <input type="submit" class="fcf-btn fcf-btn-primary fcf-btn-lg fcf-btn-block" value="Change Password">
      <input type="hidden" name="token" value="<?php echo Token::generate();?>">
      
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
function openNav() {
  document.getElementById("mySidebar").style.width = "250px";
  document.getElementById("main").style.marginLeft = "250px";
}

function closeNav() {
  document.getElementById("mySidebar").style.width = "0";
  document.getElementById("main").style.marginLeft= "0";
}
</script>
  
  
  

