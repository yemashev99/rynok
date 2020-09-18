<?php

namespace frontend\models;

use yii\base\Model;

class ProductSearch extends Model
{

    public $product;

    public function rules()
    {
        return [
            [['product'], 'string']
        ];
    }

}