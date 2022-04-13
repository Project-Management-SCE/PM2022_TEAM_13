<?php

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

class Mailer(){
	private $_mail;
	public function __construct(){
	$this->_mail = new PHPMailer(true);
	$this->_mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $this->_mail->isSMTP();                                            //Send using SMTP
    $this->_mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
	$this->_mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $this->_mail->Username   = 'automailer432@gmail.com';                     //SMTP username
    $this->_mail->Password   = '13323Gunr';                               //SMTP password
    $this->_mail->SMTPSecure = 'tls';            //Enable implicit TLS encryption
    $this->_mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
	$this->_mail->CharSet = 'UTF-8';
	$this->_mail->isHTML(true);
	$this->_mail->addAddress('automailer432@gmail.com');
	}

public function ResetPassword($email){
	$this->_mail->addAddress($email);
	$this->_mail->Subject ='Impact Israel Reset Password';
	$email=md5($email);
	$link="<a href='www.samplewebsite.com/reset.php?key=".$email"'>Click To Reset password</a>";


}

}


	?>