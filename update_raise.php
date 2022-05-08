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
    <h1 class="fcf-h3">הזנת פרטי איסוף</h1>

<?php
	if(Input::exists()){
	if(Token::check(Input::get('token'))){
	$validate =new Validate();
		$validation = $validate->check($_POST, array(
		
		'SellPrice'=>array(
			'numeric'=>true,
			'required'=>true
		)
	));
	
	if($validation->passed()){
		$arr=explode(":",Input::get('Rid'),3);
		$arr2=explode(" ",$arr[2],4);
		$id = strtok(Input::get('Rid'), ':');
		// echo $id.'<br>'.$arr[1].'<br>'.$arr2[3];
		// die();
		$mr= new MoneyRaise($id);
		$ac = new AccountMovement();
		try{
			$mr->update(array(
				'SellPrice' =>Input::get('SellPrice'),
				'collected' =>1
			));
			
			$ac->create(array(
				'Aid' =>Input::get('Aid'),
				'Rid' =>$id,
				'amount' =>Input::get('SellPrice'),
				'date'=>$arr2[3],
				'source'=>$arr[1],
				'collected'=>1
			));
			
			Session::flash('home','you have updated the raise !');
			Redirect::to('index.php');
			
		}catch(Exception $e){
			die($e->getMessage());
		}
	}
 }
}
?>
<form class="fcf-form-class" action="" method="post" >
			<div class="fcf-form-group">
				<label class="fcf-label" for="Aid">מספר עמותה</label>
				<div class="fcf-input-group" id ="first">
					<select  name="Aid" id="Aid" class="fcf-form-control" onchange="getRaises(this.value)" >
						<option value="a"> בחר עמותה</option>
						
					  
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
			</div>
			
			
		<!--	<div class="fcf-form-group">
				<label class="fcf-label" for="SellPrice">(אופציונלי)סכום איסוף כולל</label>
				<div class="fcf-input-group">
					<input type="text" class="fcf-form-control" name="SellPrice" id="SellPrice" value="<?php echo escape(Input::get('SellPrice'));  ?>" autocomplete="off">
				</div>
			</div>
			
			
			
			
			 -->
			
			<input type="submit" class="fcf-btn fcf-btn-primary fcf-btn-lg fcf-btn-block" value="עדכן גיוס">
			<input type="hidden" name="token" value="<?php echo Token::generate();?>">
			
			</form>	
	</div>
</div>	






</div>
	</body>
</html>
 

 <script type="text/javascript" src="js/getRaiseFromAmuta.js"></script>


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