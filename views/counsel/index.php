<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\StuFollowup */
/* @var $form ActiveForm */
?>
<div class="search-index">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'counsel_id') ?>
        <?= $form->field($model, 'emp_id')->textInput(['readonly' => true]) ?>
        <?= $form->field($model, 'stu_name') ?>
        <?= $form->field($model, 'stu_dob') ?>
        <?= $form->field($model, 'stu_gender') ?>
        <?= $form->field($model, 'stu_city') ?>
		<?= $form->field($model, 'stu_mobile_no') ?>
		<?= $form->field($model, 'stu_email_id') ?>
		<?= $form->field($model, 'referred_by') ?>
		<?= $form->field($model, 'summary') ?>
		<?= $form->field($model, 'comments') ?>
		<?= $form->field($model, 'stamp') ?>
    
        <div class="form-group">
            <?= Html::submitButton(Yii::t('app', 'Submit'), ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- search-index -->
