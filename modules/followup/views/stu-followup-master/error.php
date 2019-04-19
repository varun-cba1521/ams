<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use app\controllers\MailController;

/* @var $this yii\web\View */
/* @var $model app\models\StuInquiry */
/* @var $form ActiveForm */

$this->title = Yii::t('followup', 'Followup Data');
$this->params['breadcrumbs'][] = ['label' => Yii::t('followup', 'Followup'), 'url' => ['follow']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="inquiry">

    <p>You have entered the following information:</p>

<ul>
    <li><label>STU ID</label>: <?= Html::encode($model->student_id) ?></li>
    <li><label>EMP ID</label>: <?= Html::encode($model->emp_id) ?></li>
	<li><label>Status</label>: <?= Html::encode($model->status) ?></li>
	<li><label>Comments</label>: <?= Html::encode($model->comments) ?></li>
	<li><label>Pending</label>: <?= Html::encode($model->pending) ?></li>
</ul>


</div><!-- inquiry -->