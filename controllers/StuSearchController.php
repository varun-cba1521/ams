<?php

namespace app\controllers;

use Yii;

use app\models\StuSearchForm;

class StuSearchController extends \yii\web\Controller
{
    public function actionIndex()
    {
		$model = new StuSearchForm();
		$model->search_term = '';
		
		if ($model->load(Yii::$app->request->post())) {
			if ($model->validate()) {
				/* 
				 if($model->save(false)){
					return $this->redirect(['view', 'id' => $model->inquiry_id]);
				 }
				 else{
					return $this->render('success',['model' => $model]); 
				 } */
				 return $this->render('index',['model' => $model]);
			}
		}
        return $this->render('search',['model' => $model]);
    }
	
	public function actionHome($msg)
    {
		$model = new StuSearchForm();
		$model->search_term = $msg;
		
		if ($model->load(Yii::$app->request->post())) {
			if ($model->validate()) {
				/* 
				 if($model->save(false)){
					return $this->redirect(['view', 'id' => $model->inquiry_id]);
				 }
				 else{
					return $this->render('success',['model' => $model]); 
				 } */
				 return $this->render('index',['model' => $model]);
			}
		}
        return $this->render('search',['model' => $model]);
    }

}
