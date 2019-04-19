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

<?php $empSession = Yii::$app->session->get('emp_id'); ?>

<<div class="row">
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
						$followupinfo = app\models\StuFollowup::find()->where(['finder' => 0])->all(); 
					}
					else{
						$followupinfo = app\models\StuFollowup::find()->where(['emp_id' => $empSession])->all(); 
					}
				?>
				<?php $ury = app\models\StuFollowup::findBySql('select DISTINCT * from stu_info s, stu_followup f where s.stu_info_id=f.student_id')->all();
				?>
				<?php $stuinfo = app\modules\student\models\StuInfo::findBySql('Select * from stu_info')->all(); ?>
				<?php if($followupinfo) : ?>
				<?php foreach($followupinfo as $v) : ?>
					<tr>
					<?php $info1 = app\modules\student\models\StuInfo::find()->where(['stu_info_id' => $v['student_id']])->limit(1)->one();?>
						<td><?= $info1['stu_info_id']; ?></td>
						<td><?= $info1['stu_first_name']." ".$info1['stu_last_name']; ?></td>
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
						<td><?= $v['time'];?></td>
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
