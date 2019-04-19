<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

require('PHPMailer\src\PHPMailer.php');
require('PHPMailer\src\SMTP.php');
require('PHPMailer\src\Exception.php');

use app\controllers\MailController;

/* @var $this yii\web\View */
/* @var $model app\models\StuInquiry */
/* @var $form ActiveForm */

$this->title = Yii::t('dash', 'Send Mail');
$this->params['breadcrumbs'][] = ['label' => Yii::t('dash', 'Mail'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

		
?>

<h2>Sending...</h2>

<div class="inquiry">

    <p>You have entered the following information:</p>

<ul>
    <li><label>Notice Title</label>: <?= Html::encode($model->notice_title) ?></li>
</ul>

<?php
		$to_id = "varun.rajparekh@gmail.com";
		$message = "Notice Title: ". $model->notice_title ."<br/>Description: ". $model->notice_description ."<br/>Notice Date: ".$model->notice_date;
		$subject = "Notice Mail";

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
		echo $varun;

?>