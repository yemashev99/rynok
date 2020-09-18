<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "callback".
 *
 * @property int $callback_id
 * @property string $name
 * @property string $phone
 * @property string $production
 * @property string $date
 * @property string $processed
 * @property string $type
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
            [['name', 'phone', 'date', 'production', 'type'], 'string', 'max' => 255],
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
            'production' => 'Продукция',
        ];
    }

    public static function callbackCount()
    {
        $count = Callback::find()->where(['type' => 'call'])->count();
        return $count;
    }

    public static function rentCount()
    {
        $count = Callback::find()->where(['type' => 'rent'])->count();
        return $count;
    }
}
