<?php 
use yii\helpers\Html; 
$adminUser = array_keys(\Yii::$app->authManager->getRolesByUser(Yii::$app->user->getId()));
?>


<div class="row">
  <div class="col-xs-12 col-md-12 col-lg-12">
	<h2 class="page-header">	
	<i class="fa fa-info-circle"></i> <?= Html::encode(Yii::t('stu', 'Follow-up Details')) ?>
	<div class="<?= (Yii::$app->language == 'ar') ? 'pull-left' : 'pull-right'?>">
	</div>
	</h2>
  </div><!-- /.col -->
</div>

<?php
$empSession = Yii::$app->session->get('emp_id');
$info1 = $followup::find()->where(['student_id' => $stuid])->all();
$info2 = $empinfo::find()->where(['emp_info_id' => $empSession])->limit(1)->one();
?>

<<div class="row">
<div class="col-md-12">
	<div class="box box-warning">
		<div class="box-header with-border">
			<h3 class="box-title"><i class="fa fa-list-ul"></i> <?php echo Yii::t('followup', 'All Follow-ups'); ?></h3>
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
						<th><?php echo Yii::t('followup', 'Timestamp'); ?></th>
					</tr>
				</thead>
				<tbody>
				<?php if($infoa) : ?>
				<?php foreach($info1 as $v) : ?>
					<tr>
						<td><?= $v['followup_id']; ?></td>
						<td><?= $v['emp_id']?></td>
						<td><?= $v['emp_id'];?></td>
						<td><?= $v['status'];?></td>
						<td><?= $v['comments'];?></td>
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

