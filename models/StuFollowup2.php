<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "stu_followup_2".
 *
 * @property integer $followup_id
 * @property integer $student_id
 * @property integer $emp_id
 * @property string $status
 * @property string $comments
 * @property integer $pending
 * @property string $stamp
 * @property integer $finder
 *
 * @property StuMaster $student
 * @property EmpMaster $emp
 */
class StuFollowup2 extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'stu_followup_2';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['student_id', 'emp_id', 'status', 'comments', 'pending', 'finder', 'created_by'], 'required'],
            [['student_id', 'emp_id', 'pending', 'finder', 'created_by'], 'integer'],
            [['stamp'], 'safe'],
            [['status'], 'string', 'max' => 50],
            [['comments'], 'string', 'max' => 250]
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
            'stamp' => Yii::t('app', 'Stamp'),
            'finder' => Yii::t('app', 'Finder'),
			'created_by' => Yii::t('app', 'Created By'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStudent()
    {
        return $this->hasOne(StuMaster::className(), ['stu_master_id' => 'student_id']);
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
    public function getCreated()
    {
        return $this->hasOne(EmpInfo::className(), ['created_by' => 'created_by']);
    }
}
