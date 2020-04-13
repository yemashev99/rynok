<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "callback".
 *
 * @property int $callback_id
 * @property string $name
 * @property string $phone
 * @property string $date
 * @property string $processed
 */
class Callback extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'callback';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'phone', 'date', 'processed'], 'required'],
            [['name', 'phone', 'date'], 'string', 'max' => 255],
            [['processed'], 'string', 'max' => 1],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'callback_id' => 'Код',
            'name' => 'Имя',
            'phone' => 'Телефон',
            'date' => 'Дата',
            'processed' => 'Обработан',
        ];
    }

    public static function callbackCount()
    {
        $count = Callback::find()->count();
        return $count;
    }
}
