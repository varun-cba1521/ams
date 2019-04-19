<?php

namespace app\modules\followup\controllers;

use yii\web\Controller;

class DefaultController extends Controller
{
    public function actionIndex()
    {
        //Recently added student list
	$stuLast = (new \yii\db\Query())
		    ->select(['student_id', 'emp_id', 'status', 'comments', 'pending', 'time']) 
		    ->from('stu_followup')
		    ->where(['emp_id' => '6'])
		    ->orderBy('followup_id DESC')
		    ->limit(10)
		    ->all();
		return $this->render('index', ['stuLast'=>$stuLast]);
    }
}
