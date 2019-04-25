<?php

namespace app\controllers;

use app\vendor\PHPMailer\src\PHPMailer;
use app\vendor\PHPMailer\src\SMTP;
use app\vendor\PHPMailer\src\Exception;
use app\models\StuFollowup2;

class MailController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionSendmail($to_id,$message,$subject)
    {
        return $this->render('index',['to_id' => $to_id, 'message' => $message, 'subject' => $subject,]);
    }
	
	public function actionRemainder()
    {
		$model = new StuFollowup2();
        return $this->render('setremainder',['model' => $model,]);
    }
}
