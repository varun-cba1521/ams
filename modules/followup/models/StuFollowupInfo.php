<?php

namespace app\modules\followup\models;

use Yii;

/**
 * This is the model class for table "stu_followup".
 *
 * @property string $followup_id
 * @property integer $student_id
 * @property integer $emp_id
 * @property string $status
 * @property string $comments
 * @property integer $pending
 * @property string $time
 * @property integer $finder
 *
 * @property EmpMaster $emp
 * @property StuMaster $student
 */
class StuFollowupInfo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'stu_followup';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['student_id', 'emp_id', 'status', 'finder'], 'required'],
            [['student_id', 'emp_id', 'pending', 'finder'], 'integer'],
            [['time'], 'safe'],
            [['status'], 'string', 'max' => 30],
            [['comments'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'followup_id' => Yii::t('app', 'Followup ID'),
            'student_id' => Yii::t('app', 'Student ID'),
            'emp_id' => Yii::t('app', 'Emp ID'),
            'status' => Yii::t('app', 'Status'),
            'comments' => Yii::t('app', 'Comments'),
            'pending' => Yii::t('app', 'Pending'),
            'time' => Yii::t('app', 'Time'),
            'finder' => Yii::t('app', 'Finder'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEmp()
    {
        return $this->hasOne(EmpMaster::className(), ['emp_master_id' => 'emp_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStudent()
    {
        return $this->hasOne(StuMaster::className(), ['stu_master_id' => 'student_id']);
    }
}
