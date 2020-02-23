<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "product".
 *
 * @property int $product_id
 * @property int $category_id
 * @property int|null $sub_category_id
 * @property string $title
 * @property string $description
 * @property string $image
 * @property int $price
 * @property string $measure
 *
 * @property Category $category
 * @property SubCategory $subCategory
 */
class Product extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['category_id', 'title', 'description', 'image', 'price', 'measure'], 'required'],
            [['category_id', 'sub_category_id', 'price'], 'integer'],
            [['description', 'image'], 'string'],
            [['title', 'measure'], 'string', 'max' => 255],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['category_id' => 'category_id']],
            [['sub_category_id'], 'exist', 'skipOnError' => true, 'targetClass' => SubCategory::className(), 'targetAttribute' => ['sub_category_id' => 'sub_category_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'product_id' => 'Код',
            'category_id' => 'Категория',
            'sub_category_id' => 'Подкатегория',
            'title' => 'Наименование',
            'description' => 'Описание',
            'image' => 'Изображение',
            'price' => 'Цена',
            'measure' => 'Ед. измерения',
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

    /**
     * Gets query for [[SubCategory]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSubCategory()
    {
        return $this->hasOne(SubCategory::className(), ['sub_category_id' => 'sub_category_id']);
    }
}
