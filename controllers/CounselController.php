<?php

namespace app\controllers;

use Yii;
use app\models\CounselInfo;

class CounselController extends \yii\web\Controller
{
    public function actionIndex()
    {
		$model = new CounselInfo();
		
		if ($model->load(Yii::$app->request->post())) {
			if ($model->validate()) {
				
				 if($model->save(false)){
					return $this->render('viewcounselinfo',['model' => $model]);
				 }
				 else{
					return $this->render('error',['model' => $model]); 
				 }
			}
		}
        return $this->render('create',['model' => $model]);
    }
	
	public function actionView()
    {
		return $this->render('viewcounselinfo');
    }
}
