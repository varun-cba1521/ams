<?php

namespace app\modules\followup\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

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
 *
 * @property EmpMaster $emp
 * @property StuMaster $student
 */
class StuFollowup extends \yii\db\ActiveRecord
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
            [['student_id', 'emp_id', 'status'], 'required'],
            [['student_id', 'emp_id', 'pending'], 'integer'],
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
        ];
    }

/*
	public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }
*/
    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
	 /*
    public function search($params)
    {
        $query = StuFollowup::find()->where(['finder' => 0]);
	//$query->joinWith(['stuMasterStuInfo', 'stuMasterUser']);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
	    'sort'=> ['defaultOrder' => ['followup_id'=>SORT_DESC]]
        ]);
	
	
	$dataProvider->sort->attributes['stu_first_name'] = [
        'asc' => ['stu_info.stu_first_name' => SORT_ASC],
        'desc' => ['stu_info.stu_first_name' => SORT_DESC],
        ];
	
        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'followup_id' => $this->followup_id,
            'student_id' => $this->student_id,
            'emp_id' => $this->emp_id,
            'status' => $this->status,
            'comments' => $this->comments,
            'pending' => $this->pending,
            'time' => $this->time,
            'finder' => $this->finder,
        ]);
	$query->andFilterWhere(['like', 'stu_followup.status', $this->status])
	      ->andFilterWhere(['like', 'stu_followup.comments', $this->comments])
	      ->andFilterWhere(['like', 'stu_followup.time', $this->time]);

        return $dataProvider;
    }
	*/

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
