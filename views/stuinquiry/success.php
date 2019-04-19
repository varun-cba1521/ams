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

$this->title = Yii::t('app', 'Inquiry Data');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Inquiry'), 'url' => ['inquiry2']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="inquiry">

    <p>You have entered the following information:</p>

<ul>
    <li><label>Name</label>: <?= Html::encode($model->stu_name) ?></li>
    <li><label>Mobile No.</label>: <?= Html::encode($model->mobile_no) ?></li>
	<li><label>From where did you learn about our Institute ?</label>: <?= Html::encode($model->came_from) ?></li>
	<li><label>Email ID</label>: <?= Html::encode($model->email_id) ?></li>
	<li><label>City</label>: <?= Html::encode($model->city) ?></li>
	<li><label>Comments</label>: <?= Html::encode($model->comments) ?></li>
</ul>

<?php

		$to_id = "varun.rajparekh@gmail.com";
		$message = "Name: ". $model->stu_name ."<br/>Mobile No.: ". $model->mobile_no ."<br/>Email: ". $model->email_id ."<br/>City: ". $model->city ."<br/>Comments: ".$model->comments;
		$subject = "Inquiry Mail";

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


</div><!-- inquiry -->