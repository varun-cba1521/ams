<?php
use yii\helpers\Html; 
use miloschuman\highcharts\Highcharts;
use yii\web\JsExpression;

use app\modules\student\models\StuInfo;
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
				$uri = app\modules\student\models\StuInfo::findBySql('Select * from stu_info')->all();
				if($uri) : ?>
				<?php foreach($uri as $k=>$v) : ?>
					<tr>
						<td><?= ($k+1); ?></td>
						<td><?= Html::a($v['stu_first_name'].$v['stu_last_name'], ['stu-master/view', 'id'=>$v['stu_info_stu_master_id']]);?></td>
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
			    <?php echo Html::a(Yii::t('stu', 'Add Student'), ['stu-master/create'], ['class'=>'btn btn-sm btn-info btn-flat pull-left']); ?>
			<?php } ?>
			<?php echo Html::a(Yii::t('stu', 'View All Students'), ['stu-master/index'], ['class'=>'btn btn-sm btn-default btn-flat pull-right']); ?>
			<br/><br/>
			<?= Html::a(Yii::t('app', 'Inquire'), ['/stuinquiry/inquiry2'], ['class'=>'btn btn-sm btn-info btn-flat pull-left']); ?>
		</div>
	</div>	
	

</div>
</div>