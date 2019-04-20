<?php

namespace app\controllers;

use Yii;

use app\models\StuInquiry;
//use app\controllers\MailController;

class StuInquiryController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }
	
	public function actionInquiry2()
    {
		$model = new StuInquiry();
		
		if ($model->load(Yii::$app->request->post())) {
			if ($model->validate()) {
				
				 if($model->save(false)){
					return $this->render('success',['model' => $model]);
				 }
				 else{
					return $this->render('error',['model' => $model]); 
				 }
			}
		}
        return $this->render('create',['model' => $model]);
    }

}
