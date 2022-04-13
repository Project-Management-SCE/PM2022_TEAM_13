<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';


$name = $_POST['name'];
$Phonenumber = $_POST['Phone-number'];
$email = $_POST['email'];
$message = $_POST['message'];
//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
	$mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'automailer432@gmail.com';                     //SMTP username
    $mail->Password   = '13323Gunr';                               //SMTP password
    $mail->SMTPSecure = 'tls';            //Enable implicit TLS encryption
    $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
	$mail->CharSet = 'UTF-8';
    //Recipients
    $mail->setFrom($email, $name);
    $mail->addAddress('automailer432@gmail.com'); 

    //Attachments
    

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = $name.': פרי לוב ישראל';
    $mail->Body    = ' <p><b>  מספר טלפון:  '.$Phonenumber.'</b></p>  <p><b>  שם מלא: '.$name.'</b></p><p><b>  הודעה:  '.$message.'</b></p>';
    $mail->AltBody = ' מספר טלפון:'.$Phonenumber.'  שם מלא: '.$name.'הודעה:'.$message;

    $mail->send();
    echo 'Message has been sent';
	  header("Location:FreeLoveHomePage.php");
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}