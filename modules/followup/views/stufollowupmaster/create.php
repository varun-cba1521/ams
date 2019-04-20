<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\student\models\StuMaster */

use app\models\StuFollowup2;

$this->title = Yii::t('followup', 'Add Follow-up');
$this->params['breadcrumbs'][] = ['label' => Yii::t('followup', 'Follow-up'), 'url' => ['default/index']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('followup', 'Manage Follow-ups'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?php 
$empSession = Yii::$app->session->get('emp_id');
$model->emp_id = $empSession;
if(isset($stuid)){
	$model->student_id = $stuid;
}
else{
	$stuid = 0;
	//$model->student_id = $stuid;
}
$info = app\models\StuFollowup2::find()->where(['student_id' => $stuid])->limit(1)->one();
if($info){
	$model->created_by = $info['created_by'];
}
else{
	$model->created_by = $empSession;
}
?>

<div class="col-xs-12">
  <div class="col-lg-12 col-sm-12 col-xs-12 no-padding"><h3 class="box-title"><i class="fa fa-plus"></i> <?= Html::encode($this->title) ?></h3></div>
</div>

<div class="stu-master-create">
	<?= $this->render('followupform', ['model' => $model, 'stuid' => $stuid,]); ?>
</div>
