<?php

namespace common\models;

use common\models\Category;
use Yii;

/**
 * This is the model class for table "sub_category".
 *
 * @property int $sub-category_id
 * @property int $category_id
 * @property int $title
 * @property int $url
 *
 * @property Category $category
 */
class SubCategory extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sub_category';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['category_id', 'title', 'url'], 'required'],
            ['category_id', 'integer'],
            [['title', 'url'], 'string'],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['category_id' => 'category_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'sub_category_id' => 'Код',
            'category_id' => 'Категория',
            'title' => 'Название',
            'url' => 'Значение в ссылке',
        ];
    }

    /**
     * Gets query for [[Category]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['category_id' => 'category_id']);
    }

    public function getProducts()
    {
        return $this->hasMany(Product::className(), ['sub_category_id' => 'sub_category_id']);
    }
}
