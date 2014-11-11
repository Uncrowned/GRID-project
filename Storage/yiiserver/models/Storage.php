<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "storage".
 *

 * @property integer $node_id
 * @property integer $task_id
 * @property integer $answer_id
 * @property string $time
 */
class Storage extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'storage';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['node_id', 'time'], 'required'],
            [['node_id', 'task_id', 'answer_id', 'time'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'node_id' => 'Node ID',
            'task_id' => 'Task ID',
            'answer_id' => 'Answer ID',
            'time' => 'Time',
        ];
    }
}
