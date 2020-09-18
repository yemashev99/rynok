<?php


namespace backend\models;


use yii\base\Model;

class SearchForm extends Model
{
    public $title;

    public function rules()
    {
        return [
            ['title', 'required'],
            [['title'], 'string'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'title' => 'Наименование',
        ];
    }
}