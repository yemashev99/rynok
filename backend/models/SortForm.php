<?php


namespace backend\models;


use yii\base\Model;

class SortForm extends Model
{
    public $categoryId;
    public $subCategoryId;

    public function rules()
    {
        return [
            ['categoryId', 'required'],
            [['categoryId', 'subCategoryId'], 'integer'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'categoryId' => 'Категория',
            'subCategoryId' => 'Подкатегория',
        ];
    }
}