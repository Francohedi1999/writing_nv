<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Phpmailer_lib
{
	public function __construct()
	{
		log_message('debug' , 'PHPMailer class is loaded');
	}


	public function load()
	{
		require_once APPPATH.'third_party/PHPMailer/Exception.php';
		require_once APPPATH.'third_party/PHPMailer/PHPMailer.php';
		require_once APPPATH.'third_party/PHPMailer/SMTP.php';

		// require 'phpmailer/PHPMailerAutoload.php'

		// smtp configuration
		
		$mail = new PHPMailer(true);
		$mail->isSMTP();

		$mail->Mailer = "smtp";
		// $mail->SMTPDebug = 1;
		
		// $mail->host = 'smtp.gmail.com'; 
		// // $mail->host = 'smtp.googlemail.com';
		// $mail->SMTPAuth = true;
		// $mail->Username = '';
		// $mail->Password = '';
		// $mail->SMTPSecure = '';
		// $mail->port = ;


		$mail->Host       = "smtp.ionos.fr"; // SMTP server example
		$mail->SMTPDebug  = 1;                     // enables SMTP debug information (for testing)
		$mail->SMTPAuth   = true;                  // enable SMTP authentication
		$mail->Port       = 587;                    // set the SMTP port for the GMAIL server
		$mail->Username   = "testdev@unredacteur.com"; // SMTP account username example
		$mail->Password   = "Aqwzsx741852/"; 
		

		// $mail->SMTPAuth = TRUE;
		
		
		$mail->isHTML(true);

		return $mail;
	}
}
