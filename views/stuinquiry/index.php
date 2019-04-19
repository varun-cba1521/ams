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

$this->title = Yii::t('app', 'Manage Inquiry Data');
$this->params['breadcrumbs'][] = ['label' => Yii::t('followup', 'Home'), 'url' => ['default\index']];
$this->params['breadcrumbs'][] = $this->title;

?>

<?php $empSession = Yii::$app->session->get('emp_id'); ?>

<<div class="row">
<div class="col-md-12">
	<div class="box box-warning">
		<div class="box-header with-border">
			<h3 class="box-title"><i class="fa fa-list-ul"></i> <?php echo Yii::t('app', 'All Inquiries'); ?></h3>
			<div class="box-tools <?= (Yii::$app->language == 'ar') ? 'pull-left' : 'pull-right'; ?>">
				<button class="btn btn-warning btn-sm" data-widget="collapse"><i class="fa fa-minus"></i></button>
				<button class="btn btn-warning btn-sm" title="Remove" data-toggle="tooltip" data-widget="remove"><i class="fa fa-times"></i></button>
			</div>
		</div>
		<div class="box-body table-responsive">
			<table class="table no-margin">
				<thead>
					<tr>
						<th><?php echo Yii::t('app', 'Sr.No'); ?></th>
						<th><?php echo Yii::t('app', 'Candidate Name'); ?></th>
						<th><?php echo Yii::t('app', 'Email ID'); ?></th>
						<th><?php echo Yii::t('app', 'Mobile No.'); ?></th>
						<th><?php echo Yii::t('app', 'City'); ?></th>
						<th><?php echo Yii::t('app', 'Comments'); ?></th>
						<th><?php echo Yii::t('app', 'From Where?'); ?></th>
						<th><?php echo Yii::t('app', 'Timestamp'); ?></th>
					</tr>
				</thead>
				<tbody>
				 <?php
					$inquiryinfo = app\models\StuFollowup2::find()->where('inquiry_id > 0')->all(); 
				?>
				<?php if($inquiryinfo) : ?>
				<?php foreach($inquiryinfo as $v) : ?>
					<tr>
						<td><?= $v['inquiry_id']; ?></td>
						<td><?= $v['stu_name']." ".$info1['stu_last_name']; ?></td>
						<td><?= $v['email_id'];?></td>
						<td><?= $v['mobile_no'];?></td>
						<td><?= $v['city'];?></td>
						<td><?= $v['comments'];?></td>
						<td><?= $v['came_from'];?></td>
						<td><?= $v['stamp'];?></td>
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
