<?php 
require_once 'core/init.php';
require_once 'connectionoop.php';

$user = new User();
if(!$user->isLoggedIn()|| !$user->hasPermission()=="admin"){
  Redirect::to('index.php');
}

$filename = 'uploads/'.$_GET['fname'];
$id=$_GET['Fid'];
$Pid=$_GET['Pid'];

if (unlink($filename)) {
  echo 'The file ' . $filename . ' was deleted successfully!';
  $sql =sprintf("DELETE FROM files WHERE id='$id'");
  $mysqli->query($sql);
  $sql = sprintf("UPDATE projects SET hasfile=0 WHERE id='$Pid'");


  Redirect::to('downloads.php');
} else {
  echo 'There was a error deleting the file ' . $filename;
}

?>