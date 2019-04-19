<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\followup\models\StuFollowup */
/* @var $form ActiveForm */
?>
<div class="followupform">

    <?php $form = ActiveForm::begin(['id' => 'followup-form']); ?>

        <?= $form->field($model, 'student_id') ?>
		<?= $form->field($model, 'emp_id') ?>
        <?= $form->field($model, 'created_by') ?>
        <?= $form->field($model, 'status') ?>
        <?= $form->field($model, 'pending') ?>
        <?= $form->field($model, 'stamp') ?>
        <?= $form->field($model, 'comments') ?>
    
        <div class="form-group">
            <?= Html::submitButton(Yii::t('app', 'Submit'), ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- followupform -->
