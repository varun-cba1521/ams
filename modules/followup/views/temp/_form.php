<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\jui\DatePicker;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\modules\student\models\StuMaster */
/* @var $form yii\widgets\ActiveForm */
?>
<style>
.box .box-solid {
     background-color: #F8F8F8;
}
</style>

<script>
$(function () {
  $('[data-toggle="popover"]').popover({placement: function() { return $(window).width() < 768 ? 'bottom' : 'right'; }})
})
</script>


<div class="box box-solid box-warning col-xs-12 col-lg-12 no-padding">
  <div class="box-header with-border">
    <h4 class="box-title"><i class="fa fa-info-circle"></i> <?php echo Yii::t('followup', 'Academic Details'); ?></h4>
   </div>
   <div class="box-body">
   <div class="col-xs-12 col-sm-12 col-lg-12 no-padding">
    <div class="col-xs-12 col-sm-4 col-lg-4">
     <?= $form->field($model, 'stu_master_course_id')->dropDownList(ArrayHelper::map(app\modules\course\models\Courses::find()->where(['is_status' => 0])->all(),'course_id','course_name'),
		[
                    'prompt'=>Yii::t('followup', '--- Select Course ---'),
                    'onchange'=>'
                        $.get( "'.Url::toRoute('dependent/studbatch').'", { id: $(this).val() } )
                            .done(function( data ) {
                                $( "#'.Html::getInputId($model, 'stu_master_batch_id').'" ).html( data );
                            }
                        );
                    '    
                ]); ?>
    </div>

    <div class="col-xs-12 col-sm-4 col-lg-4">
    <?= $form->field($model, 'stu_master_batch_id')->dropDownList([],
		[
                    'prompt'=>Yii::t('followup', '--- Select Batch ---'),
                    'onchange'=>'
                        $.get( "'.Url::toRoute('dependent/studsection').'", { id: $(this).val() } )
                            .done(function( data ) {
                                $( "#'.Html::getInputId($model, 'stu_master_section_id').'" ).html( data );
                            }
                        );'    
                ]); ?>
    </div>
    <div class="col-xs-12 col-sm-4 col-lg-4">
    	<?= $form->field($model, 'stu_master_section_id')->dropDownList([''=>Yii::t('followup', '--- Select Section ---')]); ?>
     </div>
   </div>

   <div class="col-xs-12 col-sm-12 col-lg-12 no-padding">
    <div class="col-xs-12 col-sm-4 col-lg-4">
	<?= $form->field($info, 'stu_admission_date')->widget(yii\jui\DatePicker::className(),
                    [
			'model'=>$info,
			'attribute'=>'stu_admission_date',
                        'clientOptions' =>[
                        'dateFormat' => 'dd-mm-yyyy',
                        'changeMonth'=> true,
			'yearRange'=>'1900:'.(date('Y')+1),
                        'changeYear'=> true,
			'readOnly'=>true,
                        'autoSize'=>true,
                       // 'showOn'=> "button",
                        'buttonImage'=> Yii::$app->homeUrl."images/calendar.png",],
                        'options'=>[
			'class'=>'form-control',
                         ],]) ?>
    </div>

    <div class="col-xs-12 col-sm-4 col-lg-4">
	<?php $stuStatusData = ['0'=>'General/Default']+ArrayHelper::map(app\modules\student\models\StuStatus::find()->where(['is_status' => 0])->all(),'stu_status_id','stu_status_name');   ?>  
	<?= $form->field($model, 'stu_master_stu_status_id')->dropDownList($stuStatusData); ?>
    </div>
   </div>

  </div><!---./end box-body--->
 </div><!---./end box--->

    <div class="form-group col-xs-12 col-sm-6 col-lg-4 no-padding edusecArLangCss">
	<div class="col-xs-6">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('followup' ,'Create') : Yii::t('followup', 'Update'), ['class' => $model->isNewRecord  ? 'btn btn-block btn-success' : 'btn btn-block btn-info']) ?>
	</div>
	<div class="col-xs-6">
	    <?= Html::a(Yii::t('followup', 'Cancel'), ['index'], ['class' => 'btn btn-default btn-block']); ?>
	</div>
    </div>

    <?php ActiveForm::end(); ?>
   </div>
  </div>
</div>
