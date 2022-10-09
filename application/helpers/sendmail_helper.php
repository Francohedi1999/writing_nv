<?php
// defined('BASEPATH') OR exit('No direct script access allowed');

// use PHPMailer\PHPMailer\PHPMailer;
// use PHPMailer\PHPMailer\Exception;

// function send_mail( $email_editeur , $nom_editeur , $email_recepteur , $nom_recepteur , $objet , $message )
// {

// 	require_once APPPATH.'third_party/PHPMailer/Exception.php';
// 	require_once APPPATH.'third_party/PHPMailer/PHPMailer.php';
// 	require_once APPPATH.'third_party/PHPMailer/SMTP.php';

// 	$mail = new PHPMailer();

// 	$mail->IsSMTP();

// 	$mail->SMTPDebug  = 0;

// 	$mail->Host = "new.serveurgasy.com"; 
// 	$mail->SMTPAuth = true;
// 	$mail->SMTPSecure = 'ssl';
// 	$mail->Port = 465;               

// 	$mail->Username  = "contact@writing.booknews.today"; 
// 	$mail->Password   = "?5?sWntm}8#1";             

// 	$mail->setFrom( $email_editeur , $nom_editeur );			// email_editeur , nom_editeur
// 	$mail->addAddress( $email_recepteur );		// email_recepteur , nom_recepteur
// 	$mail->addReplyTo( $email_editeur );		// email_recepteur , nom_recepteur

// 	$mail->isHTML(true);   
// 	$mail->Subject =  $objet;									
// 	$mail->Body    = $message;                   

// 	$mail->send();
	
// }

?>