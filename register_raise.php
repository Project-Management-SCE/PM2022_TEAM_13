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
	echo '<a href="register.php">רישום משתמשים</a>';
	echo '<a href="register_amuta.php">הוספת עמותות</a>';
	echo '<a href="register_raise.php">הוספת גיוסים</a>';
	echo '<a href="update_raise.php">הזנת איסוף גיוסים</a>';
	echo '<a href="register_project.php">הוסף פרוייקט</a>';
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
    <h1 class="fcf-h3"> הוסף גיוס כספים לעמותה</h1>
	
	<?php
	if(Input::exists()){
	if(Token::check(Input::get('token'))){
	$validate =new Validate();
	if(Input::get('collected')==1){
		$validation = $validate->check($_POST, array(
		'Aid'=>array(
			'required'=>true,
			'exists'=>'association'	
		),
		'type'=>array(
			'required'=>true
		),
		'amount'=>array(
			'numeric'=>true,
			'required'=>true
		),
		'BuyPrice'=>array(
			'numeric'=>true,
			'required'=>true
		),
		'SellPrice'=>array(
			'numeric'=>true,
			'required'=>true
		),
		'StartDate'=>array(
			'required'=>true
		),
		'CollectDate'=>array(
			'required'=>true
		)
	));
	
	if($validation->passed()){
		Session::flash('success','You registered successfully!');
		$mr= new MoneyRaise();
		$ac = new AccountMovement();
		try{
			$mr->create(array(
				'Aid' =>Input::get('Aid'),
				'type' =>Input::get('type'),
				'BuyPrice' =>Input::get('BuyPrice'),
				'SellPrice' =>Input::get('SellPrice'),
				'amount' =>Input::get('amount'),
				'StartDate' =>Input::get('StartDate'),
				'CollectDate' =>Input::get('CollectDate'),
				'collected'=>Input::get('collected')
			));
			
			$db = DB::getInstance();
			$rid =$db->pdo()->lastInsertId();
			
			$ac->create(array(
				'Aid' =>Input::get('Aid'),
				'Rid' =>$rid,
				'amount' =>Input::get('amount')*Input::get('BuyPrice')*-1,
				'date'=>Input::get('StartDate'),
				'source'=>Input::get('type'),
				'collected'=>1
			));
			$ac->create(array(
				'Aid' =>Input::get('Aid'),
				'Rid' =>$rid,
				'amount' =>Input::get('SellPrice'),
				'date'=>Input::get('CollectDate'),
				'source'=>Input::get('type'),
				'collected'=>Input::get('collected')
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
	}else{
		$validation = $validate->check($_POST, array(
		'Aid'=>array(
			'required'=>true,
			'exists'=>'association'	
		),
		'type'=>array(
			'required'=>true
		),
		'amount'=>array(
			'numeric'=>true,
			'required'=>true
		),
		'BuyPrice'=>array(
			'numeric'=>true,
			'required'=>true
		),
		'StartDate'=>array(
			'required'=>true
		),
		'CollectDate'=>array(
			'required'=>true
		)
	));
	
	if($validation->passed()){
		Session::flash('success','You registered successfully!');
		$mr= new MoneyRaise();
		$ac = new AccountMovement();
		try{
			$mr->create(array(
				'Aid' =>Input::get('Aid'),
				'type' =>Input::get('type'),
				'BuyPrice' =>Input::get('BuyPrice'),
				'amount' =>Input::get('amount'),
				'StartDate' =>Input::get('StartDate'),
				'collected'=>Input::get('collected'),
				'CollectDate' =>Input::get('CollectDate'),
			));
			
			$db = DB::getInstance();
			$rid =$db->pdo()->lastInsertId();
			
			$ac->create(array(
				'Aid' =>Input::get('Aid'),
				'Rid' =>$rid,
				'amount' =>Input::get('amount')*Input::get('BuyPrice')*-1,
				'date'=>Input::get('StartDate'),
				'source'=>Input::get('type'),
				'collected'=>1
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
}
?>
		<form class="fcf-form-class" action="" method="post" >
			<div class="fcf-form-group">
				<label class="fcf-label" for="Aid">מספר עמותה</label>
				<div class="fcf-input-group">
					<select id="f4" name="Aid" id="Aid" class="fcf-form-control" >
						<option value=" "> בחר עמותה</option>
						
					  
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
			<div class="fcf-form-group">
				<label class="fcf-label" for="type">סוג גיוס</label>
				<div class="fcf-input-group">	
					<input type="text" class="fcf-form-control" name="type" id="type" value="<?php echo escape(Input::get('type'));  ?>" autocomplete="off">
				</div>	
			</div>
			<div class="fcf-form-group">
				<label class="fcf-label" for="amount">כמות(יחידות)</label>
				<div class="fcf-input-group">	
					<input type="text" class="fcf-form-control" name="amount" id="amount" value="<?php echo escape(Input::get('amount'));  ?>" autocomplete="off">
				</div>
			</div>
			<div class="fcf-form-group">
				<label class="fcf-label" for="BuyPrice">סכום ליחידה</label>
				<div class="fcf-input-group">	
					<input type="text" class="fcf-form-control" name="BuyPrice" id="BuyPrice" value="<?php echo escape(Input::get('BuyPrice'));  ?>" autocomplete="off">
				</div>	
			</div>
			
			
			<div class="fcf-form-group">
				<label class="fcf-label" for="StartDate"> תאריך תחילת גיוס</label>
				<div class="fcf-input-group">	
					<input type="date" class="fcf-form-control" name="StartDate" id="StartDate" value="<?php echo escape(Input::get('StartDate'));  ?>" autocomplete="off">
				</div>
			</div>
			
			<div class="fcf-form-group">
				<label class="fcf-label" for="CollectDate">תאריך איסוף</label>
				<div class="fcf-input-group">
					<input type="date" class="fcf-form-control" name="CollectDate" id="CollectDate" value="<?php echo escape(Input::get('CollectDate'));  ?>" autocomplete="off">
				</div>
			</div>
			
			<div class="fcf-form-group" id ="Rf">
				<label class="fcf-label" for="collected">אישור איסוף</label>	
				<div class="fcf-input-group">	
					<select name="collected" id="collected" class="fcf-form-control" onchange="RaisePick()" >
						<option value="0"> עוד לא נאסף</option>
						<option value="1">נאסף</option>
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
			
			<input type="submit" class="fcf-btn fcf-btn-primary fcf-btn-lg fcf-btn-block" value="הוסף גיוס">
			<input type="hidden" name="token" value="<?php echo Token::generate();?>">
			
			</form>	
	</div>
</div>	
	</div>
	</body>
</html>
 <script type="text/javascript" src="js/RaisePick.js"></script>


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