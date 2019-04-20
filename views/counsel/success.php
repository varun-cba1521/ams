<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\StuInquiry */
/* @var $form ActiveForm */

$this->title = Yii::t('app', 'Counseling Data');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Counseling'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="inquiry">

    <p>You have entered the following information:</p>

<ul>
    <li><label>Name</label>: <?= Html::encode($model->stu_name) ?></li>
    <li><label>Mobile No.</label>: <?= Html::encode($model->mobile_no) ?></li>
	<li><label>Referred By ?</label>: <?= Html::encode($model->referred_by) ?></li>
	<li><label>Email ID</label>: <?= Html::encode($model->stu_email_id) ?></li>
	<li><label>City</label>: <?= Html::encode($model->stu_city) ?></li>
	<li><label>Summary</label>: <?= Html::encode($model->summary) ?></li>
	<li><label>Comments</label>: <?= Html::encode($model->comments) ?></li>
</ul>

</div><!-- inquiry -->