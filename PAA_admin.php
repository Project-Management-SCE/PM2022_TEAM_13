<?php

require_once 'core/init.php';


if(isset($_GET['aid'])){
	$amut= new Amuta($_GET['aid']);
	$AsID = $_GET['aid'];
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



<script src="https://unpkg.com/resize-observer-polyfill"></script>


<link href="contact-form.css" rel="stylesheet">


<link href="PAA.css" rel="stylesheet">



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


<div style="background-color:white;border-radius: 16px;width:65%;height: auto;margin: auto;display: block;">
	<img src="impactlogo.jpeg" alt="FreeLoveLogo"  style="float:left;height: 16vw;width: 16vw;position: relative;left: 5vw;">


<h1 align="right" style="padding-bottom:10vw;font-size:5vw;padding-right:25px;position: relative;top: 5vw;" >אזור אישי <?php 
if(isset($_GET['aid']))echo $amut->data()->Aname;?></h1>
</div>

<?php 
if(!isset($_GET['aid'])){
?>
<div style="display: block;margin: auto; width: 20vw;" >
	<select name="username" id="username" class="fcf-form-control"onchange="findAmut(this.value)" >
						<option value=" ">בחר עמותה</option>
						
					  
							  <?php 

									require_once "connectionoop.php";

									$query1 = sprintf("SELECT  id,Aname,Anumber FROM association WHERE 1");
									//execute query
									$result1 = $mysqli->query($query1);

									//loop through the returned data
									
									foreach ($result1 as $data) {
									  echo "<option value='". $data['id'] ."'>" .$data['Aname']."-".$data['Anumber']."</option>";  // displaying data in option menu
									}
						?>  
					  
					  
					  </select>
</div>

<?php }else{ ?>

<button onclick='window.location.href="PAA_admin.php";' style="display: block;margin: auto;border-radius: 4px;width:auto;font-size: 32px; color:white;background-color: #4b84e7;">החלף עמותה</button>

<?php
}

	if(Input::exists()){
	if(Token::check(Input::get('token'))){
	$validate =new Validate();
	$validation = $validate->check($_POST, array(
		'Wname'=>array(
			'required'=>true,
			'min'=>2,
			'max'=>80	
		),
		'Wemail'=>array(
			'required'=>true
		),
		
		'Wphone'=>array(
			'numeric'=>true
		)
	));
	
	if($validation->passed()){
		Session::flash('success','You registered successfully!');
		
		$aid = $amut->data()->id;
		
		$cr = new Crew();
		
		try{
			$cr->create(array(
				'Aid' =>$aid,
				'Wname' =>Input::get('Wname'),
				'Wemail' =>Input::get('Wemail'),
				'Wphone' =>Input::get('Wphone'),
				'Duties' =>Input::get('Duties')
				
			));
			
			Session::flash('home','you have added the association !');
			Redirect::to('PAA_admin.php?aid='.$aid);
			
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

<br><br>

<?php 
if(isset($_GET['aid'])){
	?>

<div class="tab">
        <button class="tablinks" onclick="openCity(event, 'Raises2')" id="defaultOpen"><strong>הגיוסים שלי</strong></button>
        <button class="tablinks" onclick="openCity(event, 'MyAcc');myFunction23(<?php echo $_GET['aid'];?>)"><strong>מצב חשבון</strong></button>
        <button class="tablinks" onclick="openCity(event, 'MyPro');myFunction4(<?php echo $_GET['aid'];?>)"><strong>הפרוייקטים שלי</strong></button>
        <button class="tablinks" onclick="openCity(event, 'MyTeam');myFunction34(<?php echo $_GET['aid'];?>)"><strong>הצוות שלי</strong></button>
      </div>
      
      <div id="Raises2" class="tabcontent">
	   
        <h1 align="center">הגיוסים שלי</h1>
		<button class="m1" id="mybtn1" onclick="myFunction2(<?php echo $_GET['aid'];?>)"> רשימה מלאה</button>
		<button style="float:left;margin-right:2px;" onclick="myFunction9(<?php echo $_GET['aid'];?>)" id="mybtn"> רווחים לפי סוג גיוס</button>
		<button style="float:left;" onclick="myFunction1(<?php echo $_GET['aid'];?>)" id="mybtn2"> רווחי גיוס לאורך זמן</button>
		
        <div id="wrap" style="overflow-y:auto;">
			<canvas id="mycanvas" ></canvas>			
		</div>

	
		
		
      </div>
	  
	 
      
      <div id="MyAcc"  class="tabcontent">
        <h1 align="center">מצב חשבון</h1>
		
				<div >
						<div id="wrap2" style="overflow-y:auto;">
			
       
      			</div>
	   		</div>
     </div>


      <div id="MyPro" class="tabcontent">
        <h1 align="center"> הפרוייקטים שלי</h1>
   
      </div>
      
      <div id="MyTeam" class="tabcontent">
       <h1 align="center">הצוות שלי</h1>
       <button onclick="document.getElementById('id01').style.display='block'" style="border-radius: 4px;width:auto;font-size: 32px; color:white;" id="mybtn3">הוסף חבר צוות </button><br>
				<div id="wrap3">
			
       
			</div>
			
	   		

	   		<div id="id01" class="modal">
		
			
			
			  <form id="Cform" class="modal-content animate" action="" method="post">
			  
			  	
			
				<div class="imgcontainer">
				  <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
				 
				</div>

				<div class="container">
					  <label for="Wname">שם חבר הצוות
					  </label>
					  <input type="text" id="Wname" name="Wname"  value="<?php echo escape(Input::get('Wname'));  ?>"  autocomplete="off"><br>
					 
					 <label for="Wemail">דואר אלקטרוני</label>
					  
					  <input type="text" id="Wemail" name="Wemail"  value="<?php echo escape(Input::get('Wemail'));  ?>"  autocomplete="off"><br> 
						
						<label for="Wphone">מספר נייד</label>
					  
					  <input type="text" id="Wphone" name="Wphone"  value="<?php echo escape(Input::get('Wphone'));  ?>"  autocomplete="off"><br>
					 
					 <label for="Duties">תאור תפקיד  </label>
					
					  <input type="text" id="Duties" name="Duties"  value="<?php echo escape(Input::get('Duties'));  ?>"  autocomplete="off"><br>
					
				  <button id ="btn4" type="submit">הוסף חבר צוות</button>

				</div>

				<div class="container" style="background-color:#00ace6">
				  <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
				</div>
				<input type="hidden" name="token" value="<?php echo Token::generate();?>">
			  </form>
			</div>
				  </div>
				  
		</div>
<?php }?>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/js-polyfills/0.1.43/polyfill.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js/dist/chart.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-adapter-date-fns/dist/chartjs-adapter-date-fns.bundle.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  
 <script type="text/javascript" src="js/lineGraphNew.js"></script>
 <script type="text/javascript" src="js/RaiseBarGraph.js"></script>
<script type="text/javascript" src="js/RaiseTable.js"></script>
<script type="text/javascript" src="js/AccountMovement.js"></script>
<script type="text/javascript" src="js/CrewTable.js"></script>
<script type="text/javascript" src="js/deleteCrew.js"></script>
<script type="text/javascript" src="js/getProjects.js"></script>
<script type="text/javascript" src="js/PAA_admin.js"></script>


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