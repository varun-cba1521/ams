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

$this->title = Yii::t('followup', 'Manage Followups');
$this->params['breadcrumbs'][] = ['label' => Yii::t('followup', 'Follow Up Dashboard'), 'url' => ['default/index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<?php
$empSession = 15;
if(Yii::$app->user->can('Rights')){
?>
	<div class="row">
	<div class="col-md-12">
		<div class="box box-warning">
			<div class="box-header with-border">
				<h3 class="box-title"><i class="fa fa-list-ul"></i> <?php echo Yii::t('followup', 'All Employee Follow-ups'); ?></h3>
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
							<th><?php echo Yii::t('followup', 'Total Follow-ups'); ?></th>
							<th><?php echo Yii::t('followup', 'Pending Follow-ups'); ?></th>
						</tr>
					</thead>
					<tbody>
					<?php
					$followupinfo = app\models\StuFollowup2::find()->where(['finder' => 0])->all(); 
					$empinfo = app\modules\employee\models\EmpInfo::find()->where('emp_info_id > 0')->orderBy('emp_first_name')->all();
					$ury = app\models\StuFollowup2::findBySql('select DISTINCT * from stu_info s, stu_followup f where s.stu_info_id=f.student_id')->all();
					?>
					<?php if($empinfo) : ?>
					<?php foreach($empinfo as $v) : 
						//$followupinfopending = app\models\StuFollowup2::find()->where(['emp_id' => $v['emp_info_id']])->count(); 
					?>
					<tr>
						<td><?= $v['emp_info_id']; ?></td>
						<td><a href="index.php?r=employee/emp-master/view&id=<?= $v['emp_info_id']?>"><?= $v['emp_first_name']." ".$v['emp_middle_name']." ".$v['emp_last_name']?></a></td>
						<td><?= app\models\StuFollowup2::find()->where(['emp_id' => $v['emp_info_id']])->count()?></td>
						<td><?= app\models\StuFollowup2::find()->where(['emp_id' => $v['emp_info_id']])->andWhere(['pending' => 0])->count()?></td>
					</tr>
					<?php endforeach; ?>
					<?php else : ?>
						<tr>
							<td colspan="6" class="text-danger text-center"><?php echo Yii::t('followup', 'No results found.'); ?></td>
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
				<h3 class="box-title"><i class="fa fa-list-ul"></i> <?php echo Yii::t('followup', 'All your Follow-ups'); ?></h3>
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
							<th><?php echo Yii::t('followup', 'Recent Faculty'); ?></th>
							<th><?php echo Yii::t('followup', 'Candidate Name'); ?></th>
							<th><?php echo Yii::t('followup', 'Candidate Status'); ?></th>
							<th><?php echo Yii::t('followup', 'Comments'); ?></th>
							<th><?php echo Yii::t('followup', 'Pending'); ?></th>
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
					<?php $ury = app\models\StuFollowup2::findBySql('select DISTINCT * from stu_info s, stu_followup f where s.stu_info_id=f.student_id')->all();
					?>
					<?php $stuinfo = app\modules\student\models\StuInfo::findBySql('Select * from stu_info')->all(); ?>
					<?php if($followupinfo) : ?>
					<?php foreach($followupinfo as $v) : ?>
						<tr>
						<?php
						$info1 = app\modules\student\models\StuInfo::find()->where(['stu_info_id' => $v['student_id']])->limit(1)->one();
						$info2 = app\modules\employee\models\EmpInfo::find()->where(['emp_info_id' => $v['emp_id']])->limit(1)->one();
						?>
							<td><?= $info1['stu_info_id']; ?></td>
							<td><?= $info2['emp_first_name']." ".$info2['emp_middle_name']." ".$info2['emp_last_name']; ?></td>
							<td><a href="index.php?r=student/stu-master/view&id=<?= $v['student_id']?>"><?= $info1['stu_first_name']." ".$info1['stu_last_name']; ?></a></td>
							<td><?= $v['status'];?></td>
							<td><?= $v['comments'];?></td>
							<?php
							if($v['pending']):
								$name = "No";
							else:
								$name = "Yes";
							endif;
							?>
							<td><?= $name;?></td>
							<td><?= $v['stamp'];?></td>
							
							<td><a href="index.php?r=student/stu-master/view&id=<?= $v['student_id']?>"><span class="glyphicon glyphicon-search"></span></a></td>
							
							<td>
							<?php if($v['finder']==0) : ?>
							<span class="label label-success"><?php echo Yii::t('stu', 'Active'); ?></span>
							<?php else : ?>
							<span class="label label-danger"><?php echo Yii::t('stu', 'InActive'); ?></span>
							<?php endif; ?>
							</td>
										
						</tr>
					<?php endforeach; ?>
					<?php else : ?>
						<tr>
							<td colspan="6" class="text-danger text-center"><?php echo Yii::t('followup', 'No results found.'); ?></td>
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