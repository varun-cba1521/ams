<?php

use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\followup\models\StuMasterSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Manage Counseling Sessions');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Home'), 'url' => ['default/index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<?php
if(Yii::$app->user->can('Rights')){
$empSession = 15;
?>
	<div class="row">
	<div class="col-md-12">
		<div class="box box-warning">
			<div class="box-header with-border">
				<h3 class="box-title"><i class="fa fa-list-ul"></i> <?php echo Yii::t('followup', 'All Employee Counsels'); ?></h3>
				<div class="box-tools <?= (Yii::$app->language == 'ar') ? 'pull-left' : 'pull-right'; ?>">
					<button class="btn btn-warning btn-sm" data-widget="collapse"><i class="fa fa-minus"></i></button>
					<button class="btn btn-warning btn-sm" title="Remove" data-toggle="tooltip" data-widget="remove"><i class="fa fa-times"></i></button>
				</div>
			</div>
			<div class="box-body table-responsive">
				<table class="table no-margin">
					<thead>
						<tr>
							<th><?php echo Yii::t('followup', 'Sr.No'); ?></th>
							<th><?php echo Yii::t('followup', 'Faculty Name'); ?></th>
							<th><?php echo Yii::t('followup', 'Total Counsels'); ?></th>
						</tr>
					</thead>
					<tbody>
					<?php
					$counselinfo = app\models\CounselInfo::find()->where('counsel_id > 0')->all(); 
					$empinfo = app\modules\employee\models\EmpInfo::find()->where('emp_info_id > 0')->orderBy('emp_first_name')->all();
					?>
					<?php if($empinfo) : ?>
					<?php foreach($empinfo as $v) : ?>
					<tr>
						<td><?= $v['emp_info_id']; ?></td>
						<td><a href="index.php?r=employee/emp-master/view&id=<?= $v['emp_info_id']?>"><?= $v['emp_first_name']." ".$v['emp_last_name'];?></a></td>
						<td><?= app\models\CounselInfo::find()->where(['emp_id' => $v['emp_info_id']])->count()?></td>
					</tr>
					<?php endforeach; ?>
					<?php else : ?>
						<tr>
							<td colspan="6" class="text-danger text-center"><?php echo Yii::t('app', 'No results found.'); ?></td>
						</tr>
					<?php endif; ?>
					</tbody>
				</table>
			</div>
			<div class="box-footer clearfix">
				<?php if(Yii::$app->user->can("/followup/stufollowupmaster/createfollowup")) { ?>
				
					<?php echo Html::a(Yii::t('followup', 'Add Follow-up'), ['stufollowupmaster/createfollowup'], ['class'=>'btn btn-sm btn-info btn-flat pull-left']); ?>
				<?php } ?>
			</div>
		</div>	
		

	</div>
	</div>
<?php
}
?>

<?php 
if(Yii::$app->user->can('/followup/stufollowupmaster/createfollowup')){
$empSession = Yii::$app->session->get('emp_id'); ?>
	<div class="row">
	<div class="col-md-12">
		<div class="box box-warning">
			<div class="box-header with-border">
				<h3 class="box-title"><i class="fa fa-list-ul"></i> <?php echo Yii::t('followup', 'All your Counsels'); ?></h3>
				<div class="box-tools <?= (Yii::$app->language == 'ar') ? 'pull-left' : 'pull-right'; ?>">
					<button class="btn btn-warning btn-sm" data-widget="collapse"><i class="fa fa-minus"></i></button>
					<button class="btn btn-warning btn-sm" title="Remove" data-toggle="tooltip" data-widget="remove"><i class="fa fa-times"></i></button>
				</div>
			</div>
			<div class="box-body table-responsive">
				<table class="table no-margin">
					<thead>
						<tr>
							<th><?php echo Yii::t('followup', 'Sr.No'); ?></th>
							<th><?php echo Yii::t('followup', 'Candidate Name'); ?></th>
							<th><?php echo Yii::t('followup', 'Candidate Moble No.'); ?></th>
							<th><?php echo Yii::t('followup', 'summary'); ?></th>
							<th><?php echo Yii::t('followup', 'Comments'); ?></th>
							<th><?php echo Yii::t('followup', 'Timestamp'); ?></th>
						</tr>
					</thead>
					<tbody>
					 <?php
						if($empSession == null || $empSession == ''){
							$followupinfo = app\models\StuFollowup2::find()->where(['finder' => 0])->all(); 
						}
						else{
							//$followupinfo = app\models\StuFollowup2::find()->where(['created_by' => $empSession])->all(); 
							$followupinfo = app\models\StuFollowup2::findBySql('select *, count(*) as rn from stu_followup_2 f JOIN stu_info s on f.student_id = s.stu_info_id group by f.student_id')->all(); 
						}
					?>
					<?php
					$counselinfo = app\models\CounselInfo::find()->where(['emp_id' => $empSession])->orderBy('stamp DESC')->all();
					?>
					<?php $stuinfo = app\modules\student\models\StuInfo::findBySql('Select * from stu_info')->all(); ?>
					<?php if($counselinfo) : ?>
					<?php foreach($counselinfo as $v) : ?>
						<tr>
						<?php
						//$info1 = app\modules\student\models\StuInfo::find()->where(['stu_info_id' => $v['student_id']])->limit(1)->one();
						$info2 = app\modules\employee\models\EmpInfo::find()->where(['emp_info_id' => $v['emp_id']])->limit(1)->one();
						?>
							<td><?= $v['counsel_id']; ?></td>
							<td><?= $v['stu_name'];?></td>
							<td><?= $v['stu_mobile_no'];?></td>
							<td><?= $v['summary'];?></td>
							<td><?= $v['comments'];?></td>
							<td><?= $v['stamp'];?></td>
						</tr>
					<?php endforeach; ?>
					<?php else : ?>
						<tr>
							<td colspan="6" class="text-danger text-center"><?php echo Yii::t('app', 'No results found.'); ?></td>
						</tr>
					<?php endif; ?>
					</tbody>
				</table>
			</div>
			<div class="box-footer clearfix">
				<?php if(Yii::$app->user->can("/counsel/index")) { ?>
				
					<?php echo Html::a(Yii::t('app', 'Add Counsel Data'), ['index'], ['class'=>'btn btn-sm btn-info btn-flat pull-left']); ?>
				<?php } ?>
			</div>
		</div>	
		

	</div>
	</div>
<?php
}
?>