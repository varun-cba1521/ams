<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use app\controllers\MailController;

require('PHPMailer\src\PHPMailer.php');
require('PHPMailer\src\SMTP.php');
require('PHPMailer\src\Exception.php');

/* @var $this yii\web\View */
/* @var $model app\models\StuInquiry */
/* @var $form ActiveForm */

$empSession = Yii::$app->session->get('emp_id');

$pending_count = $model::find()->where(['emp_id' => $empSession])->andWhere(['pending' => 0])->count();

?>

<h1>Send Mail PHP File</h1>

<?php
		$to_id = "varun.rajparekh@gmail.com";
		//$message = "Name: Vikrant Patel - CSE Dept<br/>Status: Fees Pending<br/>Followup Required";
		$message = $pending_count." Follow-ups Pending";
		$subject = "Followup Remaider";
		
		
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
		  $result = "Message sent!";
		} else {
		  $result = "Mailer Error: " . $mail->ErrorInfo;
		}
?>

<h3><?= $result ?></h3>

