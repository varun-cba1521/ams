<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\StuInquiry */
/* @var $form ActiveForm */
?>
<div class="inquiry">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'stu_name') ?>
        <?= $form->field($model, 'mobile_no') ?>
        <?= $form->field($model, 'came_from') ?>
        <?= $form->field($model, 'email_id') ?>
        <?= $form->field($model, 'city') ?>
        <?= $form->field($model, 'comments') ?>
    
        <div class="form-group">
            <?= Html::submitButton(Yii::t('app', 'Submit'), ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- inquiry -->
