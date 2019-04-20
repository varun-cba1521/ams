<?php 
use yii\helpers\Html; 
$adminUser = array_keys(\Yii::$app->authManager->getRolesByUser(Yii::$app->user->getId()));
?>


<div class="row">
  <div class="col-xs-12 col-md-12 col-lg-12">
	<h2 class="page-header">	
	<i class="fa fa-info-circle"></i> <?= Html::encode(Yii::t('emp', 'Follow-up Details')) ?>
	<div class="<?= (Yii::$app->language == 'ar') ? 'pull-left' : 'pull-right'?>">
	</div>
	</h2>
  </div><!-- /.col -->
</div>

<?php
$info1 = $followup::find()->where(['emp_id' => $empid])->orderBy('stamp DESC')->all();
?>

<div class="row">
<div class="col-md-12">
	<div class="box box-warning">
		<div class="box-header with-border">
			<h3 class="box-title"><i class="fa fa-list-ul"></i> <?php echo Yii::t('followup', ''); ?></h3>
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
						<th><?php echo Yii::t('followup', 'Follow-up Status'); ?></th>
						<th><?php echo Yii::t('followup', 'Comments'); ?></th>
						<th><?php echo Yii::t('followup', 'Timestamp'); ?></th>
					</tr>
				</thead>
				<tbody>
				<?php if($info1) : ?>
				<?php foreach($info1 as $v) :
				$info2 = $empinfo::find()->where(['emp_info_id' => $v['emp_id']])->limit(1)->one();
				?>
					<tr>
						<td><?= $v['followup_id']; ?></td>
						<td><?= $info2['emp_first_name']?></br><?= $info2['emp_last_name']?></td>
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
	</div>
</div>
</div>

