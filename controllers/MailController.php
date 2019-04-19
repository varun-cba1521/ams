<?php

namespace app\controllers;

require('PHPMailer\src\PHPMailer.php');
require('PHPMailer\src\SMTP.php');
require('PHPMailer\src\Exception.php');

class MailController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionSendmail($to_id,$message,$subject)
    {
		/* 
		$to_id = "varun.rajparekh@gmail.com";
		$message = "Name: Vikrant Patel - CSE Dept<br/>Status: Fees Pending<br/>Followup Required";
		$subject = "Followup Remaider";
		*/
		
		$mail = new PHPMailer\PHPMailer\PHPMailer();
		$mail->IsSMTP();
		$mail->SMTPAuth = true;
		$mail->Host = 'smtp.gmail.com';
		$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
		//$mail->Port = 465;
		$mail->Port = 587;
		$mail->Username = 'hello310.12345@gmail.com';
		$mail->Password = 'Hello_310@12345';

		$mail->From = 'hello310.12345@gmail.com';
		$mail->FromName = 'ICT-AMS Portal';
		$mail->addAddress($to_id);

		// Email Sending Details
		$mail->addAddress($to_id);
		$mail->Subject = $subject;
		$mail->msgHTML($message);

		if($mail->Send()) {
		  $varun = "Message sent!";
		} else {
		  $varun = "Mailer Error: " . $mail->ErrorInfo;
		}
        return $this->render('success',['msg' => $varun]);
    }

}
