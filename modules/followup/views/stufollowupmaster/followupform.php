<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\jui\DatePicker;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\modules\followup\models\StuFollowup */
/* @var $form ActiveForm */

?>
<div class="followupform">

    <?php $form = ActiveForm::begin(['id' => 'followup-form']); ?>

        <?= $form->field($model, 'student_id') ?>
		<?= $form->field($model, 'emp_id')->textInput(['readonly' => true]) ?>
		<?= $form->field($model, 'created_by')->textInput(['readonly' => true]) ?>
		<?= $form->field($model, 'status')->dropDownList(ArrayHelper::map(app\modules\student\models\StuStatus::find()->where(['is_status' => 0])->all(),'stu_status_name','stu_status_description'),['prompt'=>Yii::t('stu', '---  Select Status ---')]); ?>
		<?= $form->field($model, 'pending')->radioList(array(0=>'Yes',1=>'No')); ?>
        <?= $form->field($model, 'stamp') ?>
        <?= $form->field($model, 'comments')->textarea(['rows' => 6]) ?>
    
        <div class="form-group">
            <?= Html::submitButton(Yii::t('app', 'Submit'), ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- followupform -->
