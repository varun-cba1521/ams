<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use miloschuman\highcharts\Highcharts;
use yii\web\JsExpression;

/* @var $this yii\web\View */
/* @var $model app\models\StuInquiry */
/* @var $form ActiveForm */

use app\modules\student\models\StuInfo;
?>

<div class="inquiry">
<div class = "row">
   <div class = "col-lg-5">

    <?php $form = ActiveForm::begin(['id' => 'search-form']); ?>

        <?= $form->field($model, 'search_term') ?>
    
        <div class="form-group">
            <?= Html::submitButton(Yii::t('app', 'Submit'), ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>
	</div>
</div>

</div><!-- inquiry -->

<?php
$data = $model->search_term;
if($data){
	$uri = app\modules\student\models\StuInfo::find()->where(['stu_info_id' => $data])->orWhere(['like','stu_first_name',$data])->orWhere(['like','stu_last_name',$data])->orWhere(['like','stu_birthplace',$data])->orWhere(['like','stu_mobile_no',$data])->all();
	
	$empinfo = app\modules\employee\models\EmpInfo::find()->where(['emp_info_id' => $data])->orWhere(['like','emp_first_name',$data])->orWhere(['like','emp_last_name',$data])->orWhere(['like','emp_birthplace',$data])->orWhere(['like','emp_mobile_no',$data])->all();
	if($uri){
	?>
<div class="row">
<div class="col-md-12">
	<div class="box box-info">
		<div class="box-header with-border">
			<h3 class="box-title"><i class="fa fa-list-ul"></i> <?php echo Yii::t('app', 'Student Data'); ?></h3>
			<div class="box-tools <?= (Yii::$app->language == 'ar') ? 'pull-left' : 'pull-right'; ?>">
				<button class="btn btn-info btn-sm" data-widget="collapse"><i class="fa fa-minus"></i></button>
				<button class="btn btn-info btn-sm" title="Remove" data-toggle="tooltip" data-widget="remove"><i class="fa fa-times"></i></button>
			</div>
		</div>
		<div class="box-body table-responsive">
			<table class="table no-margin">
				<thead>
					<tr>
						<th><?php echo Yii::t('stu', 'Sr.No'); ?></th>
						<th><?php echo Yii::t('stu', 'Student Name'); ?></th>
						<th><?php echo Yii::t('stu', 'Email ID'); ?></th>
						<th><?php echo Yii::t('stu', 'Mobile No.'); ?></th>
						<th><?php echo Yii::t('stu', 'Location'); ?></th>
					</tr>
				</thead>
				<tbody>
				<?php
				if($uri) : ?>
				<?php foreach($uri as $k=>$v) : ?>
					<tr>
						<td><?= ($k+1); ?></td>
						<td><?= Html::a($v['stu_first_name']." ".$v['stu_last_name'], ['student/stu-master/view', 'id'=>$v['stu_info_stu_master_id']]);?></td>
						<td><?= $v['stu_email_id'];?></td>
						<td><?= $v['stu_mobile_no'];?></td>
						<td><?= $v['stu_birthplace'];?></td>
					</tr>
				<?php endforeach; ?>
				<?php else : ?>
					<tr>
						<td colspan="6" class="text-danger text-center"><?php echo Yii::t('stu', 'No results found.'); ?></td>
					</tr>
				<?php endif; ?>
				</tbody>
			</table>
		</div>
		<div class="box-footer clearfix">
			<?php if(Yii::$app->user->can("/student/stu-master/create")) { ?>
			    <?php echo Html::a(Yii::t('stu', 'Add Student'), ['student/stu-master/create'], ['class'=>'btn btn-sm btn-info btn-flat pull-left']); ?>
			<?php } ?>
			<?php echo Html::a(Yii::t('stu', 'View All Students'), ['student/stu-master/index'], ['class'=>'btn btn-sm btn-default btn-flat pull-right']); ?>
			<br/><br/>
			<?= Html::a(Yii::t('app', 'Inquire'), ['/stuinquiry/inquiry2'], ['class'=>'btn btn-sm btn-info btn-flat pull-left']); ?>
		</div>
	</div>	
</div>
</div>
	<?php } ?>
	
	<?php if($empinfo){ ?>
		
<div class="row">
<div class="col-md-12">
	<div class="box box-info">
		<div class="box-header with-border">
			<h3 class="box-title"><i class="fa fa-list-ul"></i> <?php echo Yii::t('app', 'Employee Data'); ?></h3>
			<div class="box-tools <?= (Yii::$app->language == 'ar') ? 'pull-left' : 'pull-right'; ?>">
				<button class="btn btn-info btn-sm" data-widget="collapse"><i class="fa fa-minus"></i></button>
				<button class="btn btn-info btn-sm" title="Remove" data-toggle="tooltip" data-widget="remove"><i class="fa fa-times"></i></button>
			</div>
		</div>
		<div class="box-body table-responsive">
			<table class="table no-margin">
				<thead>
					<tr>
						<th><?php echo Yii::t('stu', 'Sr.No'); ?></th>
						<th><?php echo Yii::t('stu', 'Employee Name'); ?></th>
						<th><?php echo Yii::t('stu', 'Email ID'); ?></th>
						<th><?php echo Yii::t('stu', 'Mobile No.'); ?></th>
						<th><?php echo Yii::t('stu', 'Location'); ?></th>
					</tr>
				</thead>
				<tbody>
				<?php
				if($empinfo) : ?>
				<?php foreach($empinfo as $k=>$v) : ?>
					<tr>
						<td><?= ($k+1); ?></td>
						<td><?= Html::a($v['emp_first_name']." ".$v['emp_last_name'], ['employee/emp-master/view', 'id'=>$v['emp_info_emp_master_id']]);?></td>
						<td><?= $v['emp_email_id'];?></td>
						<td><?= $v['emp_mobile_no'];?></td>
						<td><?= $v['emp_birthplace'];?></td>
					</tr>
				<?php endforeach; ?>
				<?php else : ?>
					<tr>
						<td colspan="6" class="text-danger text-center"><?php echo Yii::t('emp', 'No results found.'); ?></td>
					</tr>
				<?php endif; ?>
				</tbody>
			</table>
		</div>
		<div class="box-footer clearfix">
			<?php if(Yii::$app->user->can("/employee/emp-master/create")) { ?>
			    <?php echo Html::a(Yii::t('emp', 'Add Employee'), ['employee/emp-master/create'], ['class'=>'btn btn-sm btn-info btn-flat pull-left']); ?>
			<?php } ?>
			<?php echo Html::a(Yii::t('emp', 'View All Employees'), ['employee/emp-master/index'], ['class'=>'btn btn-sm btn-default btn-flat pull-right']); ?>
		</div>
	</div>	
</div>
</div>
		
	<?php } ?>
	

</div><!-- inquiry -->
<?php
}
?>
