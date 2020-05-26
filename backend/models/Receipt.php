<?php

namespace backend\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "receipt".
 *
 * @property int $check_id
 * @property string $customer
 * @property int|null $created_at
 * @property int|null $updated_at
 */
class Receipt extends \yii\db\ActiveRecord
{

    /**
     * @return array
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'receipt';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['customer'], 'required'],
            [['created_at', 'updated_at'], 'integer'],
            [['customer'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'check_id' => 'Check ID',
            'customer' => 'Customer',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
