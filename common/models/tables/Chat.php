<?php

namespace common\models\tables;

use Yii;

/**
 * This is the model class for table "chat".
 *
 * @property int $id
 * @property string $channel
 * @property string $message
 * @property int $user_id
 * @property string $created_at
 */
class Chat extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'chat';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id'], 'integer'],
            [['created_at'], 'safe'],
            [['channel', 'message'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'channel' => 'Channel',
            'message' => 'Message',
            'user_id' => 'User ID',
            'created_at' => 'Created At',
        ];
    }
}
