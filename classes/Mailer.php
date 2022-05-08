<?php

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';
require_once 'core/init.php';

class Mailer{
	private $_mail;
	public function __construct(){
	$this->_mail = new PHPMailer(true);
	$this->_mail->SMTPDebug = 0;                      //Enable verbose debug output
    $this->_mail->isSMTP();                                            //Send using SMTP
    $this->_mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
	$this->_mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $this->_mail->Username   = 'impactmailer@gmail.com';                     //SMTP username
    $this->_mail->Password   = 'impact3163';                               //SMTP password
    $this->_mail->SMTPSecure = 'tls';            //Enable implicit TLS encryption
    $this->_mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
	$this->_mail->CharSet = 'UTF-8';
	$this->_mail->addAddress('impactmailer@gmail.com');
	}

	public function ResetPassword($email){
	
	try{
		$this->_mail->addAddress($email);
		$this->_mail->Subject ='Impact Israel Reset Password';
		$email=md5($email);
		$link="<a href='https://www.impactisrael.online/reset.php?key=".$email."'>Click To Reset password</a>";
		$this->_mail->Body = '<p><b>hello dear user in order to reset your password click the following link</b></p> : '.$link;
		$this->_mail->isHTML(true);

		$this->_mail->send();

	}catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
	}
	

	}
	public function EmailConfirm($email){
		
try{
		$this->_mail->addAddress($email);
		$this->_mail->Subject ='Impact Israel activate your account';
		$email=md5($email);
		$link="<a href='https://www.impactisrael.online/Activate.php?key=".$email."'>Click To Activate</a>";
		$this->_mail->Body = '<p><b>hello dear user in order to activate your account click the following link</b></p> : '.$link;
		$this->_mail->isHTML(true);

		$this->_mail->send();

	}catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
	}

	}


}


	?>