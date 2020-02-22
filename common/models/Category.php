<?php

namespace common\models;

use common\models\SubCategory;
use Yii;

/**
 * This is the model class for table "sidebar".
 *
 * @property int $category_id
 * @property int $menu_id
 * @property string $title
 * @property string $url
 */
class Category extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['menu_id', 'title', 'url'], 'required'],
            [['menu_id'], 'integer'],
            [['title', 'url'], 'string', 'max' => 255],
            [['menu_id'], 'exist', 'skipOnError' => true, 'targetClass' => Menu::className(), 'targetAttribute' => ['menu_id' => 'menu_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'category_id' => 'Код',
            'menu_id' => 'Пункт меню',
            'title' => 'Название',
            'url' => 'Значение в ссылке',
        ];
    }

    /**
     * Gets query for [[Menu]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMenu()
    {
        return $this->hasOne(Menu::className(), ['menu_id' => 'menu_id']);
    }

    public function getSubCategories()
    {
        return $this->hasMany(SubCategory::className(), ['category_id' => 'category_id']);
    }
}
