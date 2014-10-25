<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "files".
 *
 * @property integer $id
 * @property string $name_file
 * @property integer $download
 * @property integer $count
 * @property string $hash
 */
class Files extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'files';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name_file', 'download', 'count', 'hash'], 'required'],
            [['download', 'count'], 'integer'],
            [['name_file'], 'string', 'max' => 255],
            [['hash'], 'string', 'max' => 32],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name_file' => 'Name File',
            'download' => 'Download',
            'count' => 'Count',
            'hash' => 'Hash',
        ];
    }
}
