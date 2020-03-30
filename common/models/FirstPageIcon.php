<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "first_page_icon".
 *
 * @property int $first_page_icon_id
 * @property int $category_id
 * @property string $image_name
 * @property string $options
 *
 * @property Category $category
 */
class FirstPageIcon extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'first_page_icon';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['category_id', 'image_name', 'options'], 'required'],
            [['category_id'], 'integer'],
            [['image_name', 'options'], 'string', 'max' => 255],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['category_id' => 'category_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'first_page_icon_id' => 'First Page Icon ID',
            'category_id' => 'Category ID',
            'image_name' => 'Image Name',
            'options' => 'Options',
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
}
