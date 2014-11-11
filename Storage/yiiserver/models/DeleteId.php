<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "delete_id".
 *
 * @property integer $delete_id
 */
class DeleteId extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'delete_id';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['delete_id'], 'required'],
            [['delete_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'delete_id' => 'Delete ID',
        ];
    }
}
