<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "stu_inquiry".
 *
 * @property integer $inquiry_id
 * @property string $stu_name
 * @property string $email_id
 * @property string $mobile_no
 * @property string $city
 * @property string $comments
 * @property string $came_from
 * @property string $stamp
 */
class StuInquiry extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'stu_inquiry';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['stu_name', 'mobile_no', 'came_from'], 'required'],
            [['mobile_no'], 'integer'],
            [['stamp'], 'safe'],
            [['stu_name'], 'string', 'max' => 30],
            [['email_id'], 'string', 'max' => 32],
            [['city'], 'string', 'max' => 15],
            [['comments'], 'string', 'max' => 200],
            [['came_from'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'inquiry_id' => Yii::t('app', 'Inquiry ID'),
            'stu_name' => Yii::t('app', 'Stu Name'),
            'email_id' => Yii::t('app', 'Email ID'),
            'mobile_no' => Yii::t('app', 'Mobile No'),
            'city' => Yii::t('app', 'City'),
            'comments' => Yii::t('app', 'Comments'),
            'came_from' => Yii::t('app', 'Came From'),
            'stamp' => Yii::t('app', 'Stamp'),
        ];
    }
}
