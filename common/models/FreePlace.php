<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "free_place".
 *
 * @property int $free_place_id
 * @property int $free
 */
class FreePlace extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'free_place';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['free'], 'required'],
            [['free'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'free_place_id' => 'Free Place ID',
            'free' => 'Свободных мест',
        ];
    }

    public static function getFreePlaces()
    {
        $places = FreePlace::findOne(['free_place_id' => 1]);
        $result = $places->free.' '.FreePlace::declensionWords($places->free);
        return $result;
    }

    private static function declensionWords($n)
    {
        $words = ['место', 'места', 'мест'];
        return ($words[($n=($n=$n%100)>19?($n%10):$n)==1?0 : (($n>1&&$n<=4)?1:2)]);
    }
}
