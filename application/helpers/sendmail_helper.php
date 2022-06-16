<?php
// defined('BASEPATH') OR exit('No direct script access allowed');

// use PHPMailer\PHPMailer\PHPMailer;
// use PHPMailer\PHPMailer\Exception;

// function send_mail( $email_editeur , $nom_editeur , $email_recepteur , $nom_recepteur , $objet , $message )
// {

// 	require_once APPPATH.'third_party/PHPMailer/Exception.php';
// 	require_once APPPATH.'third_party/PHPMailer/PHPMailer.php';
// 	require_once APPPATH.'third_party/PHPMailer/SMTP.php';

// 	$mail = new PHPMailer(true);

// 	$mail->IsSMTP();

// 	$mail->CharSet = 'UTF-8';

// 	$mail->SMTPDebug  = 0;                     

// 	$mail->SMTPAuth   = true;       
	
// 	$mail->SMTPSecure = 'ssl';
	
// 	$mail->Host       = "new.serveurgasy.com"; 

// 	$mail->Port       = 465;               

// 	$mail->Username   = "contact@writing.booknews.today"; 

// 	$mail->Password   = "?5?sWntm}8#1";             

// 	$mail->setFrom( $email_editeur , $nom_editeur );			// email_editeur , nom_editeur
	
// 	$mail->Subject =  $objet;									// objet

// 	$mail->Body    = $message;	                                // message

// 	$mail->addAddress( $email_recepteur , $nom_recepteur );		// email_recepteur , nom_recepteur

// 	$mail->isHTML(true);                  

// 	$mail->send();
	
// }

?>