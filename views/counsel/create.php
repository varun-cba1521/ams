<?php

use yii\helpers\Html;

/* @var $this yii\web\View */

$this->title = Yii::t('app','Add Counsel Info');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app','Home'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$empSession = Yii::$app->session->get('emp_id');
$model->emp_id = $empSession;
?>
<div class="stu-address-create">

    <h1><?= Html::encode($this->title) ?></h1>
	
    <?= $this->render('index', [
        'model' => $model,
    ]) ?>

</div>
