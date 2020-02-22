<?php

namespace common\models;

use yii\db\ActiveRecord;
use himiklab\sortablegrid\SortableGridBehavior;

class Menu extends ActiveRecord
{

    public function behaviors()
    {
        return [
            'sort' => [
                'class' => SortableGridBehavior::className(),
                'sortableAttribute' => 'sort'
            ],
        ];
    }

    public function rules()
    {
        return [
            ['title', 'required'],
            ['title', 'string'],
            ['sort', 'integer'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'menu_id' => 'Код',
            'sort' => 'Порядковый номер',
            'title' => 'Название',
            'url' => 'Ссылка',
        ];
    }
}