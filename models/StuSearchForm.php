<?php

namespace app\models;

use Yii;
use yii\base\Model;

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
class StuSearchForm extends Model
{
    /**
     * @inheritdoc
     */
	 public $search_term;
	 
	 public function rules()
    {
        return [
            [['search_term'], 'required'],
        ];
    }
	 
    public function attributeLabels()
    {
        return [
            'search_term' => 'Search Phrase',
        ];
    }
}
