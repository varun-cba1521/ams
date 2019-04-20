<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "counsel_info".
 *
 * @property integer $counsel_id
 * @property string $stu_name
 * @property string $stu_dob
 * @property string $stu_gender
 * @property string $stu_city
 * @property string $stu_mobile_no
 * @property string $stu_email_id
 * @property string $referred_by
 * @property string $summary
 * @property string $comments
 * @property string $stamp
 * @property integer $emp_id
 *
 * @property EmpMaster $counsel
 */
class CounselInfo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'counsel_info';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['stu_name', 'stu_mobile_no', 'referred_by', 'summary', 'comments', 'emp_id'], 'required'],
            [['stu_dob', 'stamp'], 'safe'],
            [['stu_mobile_no', 'emp_id'], 'integer'],
            [['stu_name'], 'string', 'max' => 50],
            [['stu_gender'], 'string', 'max' => 10],
            [['stu_city', 'referred_by'], 'string', 'max' => 30],
            [['stu_email_id'], 'string', 'max' => 32],
            [['summary'], 'string', 'max' => 350],
            [['comments'], 'string', 'max' => 150]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'counsel_id' => Yii::t('app', 'Counsel ID'),
            'stu_name' => Yii::t('app', 'Stu Name'),
            'stu_dob' => Yii::t('app', 'Stu Dob'),
            'stu_gender' => Yii::t('app', 'Stu Gender'),
            'stu_city' => Yii::t('app', 'Stu City'),
            'stu_mobile_no' => Yii::t('app', 'Stu Mobile No'),
            'stu_email_id' => Yii::t('app', 'Stu Email ID'),
            'referred_by' => Yii::t('app', 'Referred By'),
            'summary' => Yii::t('app', 'Summary'),
            'comments' => Yii::t('app', 'Comments'),
            'stamp' => Yii::t('app', 'Stamp'),
            'emp_id' => Yii::t('app', 'Emp ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCounsel()
    {
        return $this->hasOne(EmpMaster::className(), ['emp_master_id' => 'counsel_id']);
    }
}
