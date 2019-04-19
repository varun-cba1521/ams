<?php

use yii\helpers\Html;

/* @var $this yii\web\View */

$this->title = Yii::t('app','Search Students');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app','Form'), 'url' => ['search']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="stu-address-create">

    <h1><?= Html::encode($this->title) ?></h1>
	
    <?= $this->render('index', [
        'model' => $model,
    ]) ?>


</div>
