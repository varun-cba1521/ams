<?php

use yii\helpers\Html;

/* @var $this yii\web\View */

$this->title = Yii::t('app','Make an Inquiry');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app','Home'), 'url' => ['inquiry2']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="stu-address-create">

    <h1><?= Html::encode($this->title) ?></h1>
	
    <?= $this->render('inquiry2', [
        'model' => $model,
    ]) ?>

</div>
