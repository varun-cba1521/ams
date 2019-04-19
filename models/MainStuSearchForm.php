<?php
   namespace app\models;
   use Yii;
   use yii\base\Model;
   class MainStuSearchForm extends Model {
      public $message;
      /**
      * @return array customized attribute labels
      */
      public function attributeLabels() {
         return [
            'message' => 'Message',
         ];
      }
   }
?>