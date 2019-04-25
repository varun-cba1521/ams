<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\StuFollowup */
/* @var $form ActiveForm */
?>
<div class="search-index">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'emp_id')->textInput(['readonly' => true]) ?>
        <?= $form->field($model, 'stu_name')->textInput(); ?>
		<?= $form->field($model, 'stu_dob')->widget(yii\jui\DatePicker::className(),
	            [
			'model'=>$model,
			'attribute'=>'stu_dob', 
	            'clientOptions' =>[
	                'dateFormat' => 'dd-mm-yyyy',
	                'changeMonth'=> true,
			'yearRange'=>'1900:'.(date('Y')+1),
	                'changeYear'=> true,
			'readOnly'=>true,
	                'autoSize'=>true,],
	            'options'=>[
			'class'=>'form-control',
	                 ],]) 
		?>
        <?= $form->field($model, 'stu_gender')->dropDownList(['Female'=>'Female','Male'=>'Male','Other'=>'Other']); ?>
        <?= $form->field($model, 'stu_city')->textInput(); ?>
		<?= $form->field($model, 'stu_mobile_no')->textInput(['maxlength' => '12']) ?>
		<?= $form->field($model, 'stu_email_id')->input('email') ?>
		<?= $form->field($model, 'referred_by')->textInput(); ?>
		<?= $form->field($model, 'summary')->textarea(['rows' => 6]) ?>
		<?= $form->field($model, 'comments')->textarea(['rows' => 6]) ?>
    
        <div class="form-group">
            <?= Html::submitButton(Yii::t('app', 'Submit'), ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- search-index -->
