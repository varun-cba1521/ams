<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\student\models\StuMaster */

$this->title = Yii::t('followup', 'Add Follow-up');
$this->params['breadcrumbs'][] = ['label' => Yii::t('followup', 'Follow-up'), 'url' => ['default/index']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('followup', 'Manage Follow-ups'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?php 
$empSession = Yii::$app->session->get('emp_id');
$model->emp_id = $empSession;
?>

<div class="col-xs-12">
  <div class="col-lg-12 col-sm-12 col-xs-12 no-padding"><h3 class="box-title"><i class="fa fa-plus"></i> <?= Html::encode($this->title) ?></h3></div>
</div>

<div class="stu-master-create">
    <?= $this->render('followupform', ['model' => $model]) ?>
</div>
