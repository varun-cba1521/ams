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


</div><!-- inquiry -->