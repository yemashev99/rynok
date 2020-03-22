<?php

namespace common\models;

use common\models\SubCategory;
use Yii;
use yii\web\UploadedFile;

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

    const BACKEND_PATH = 'image/category/';

    public $file;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['menu_id', 'title', 'url'], 'required'],
            [['menu_id'], 'integer'],
            [['title', 'url'], 'string', 'max' => 255],
            [['image'], 'string'],
            [['file'], 'file', 'extensions' => ['png', 'jpg', 'jpeg']],
            [['menu_id'], 'exist', 'skipOnError' => true, 'targetClass' => Menu::className(), 'targetAttribute' => ['menu_id' => 'menu_id']],
            ['content', 'string']
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
            'file' => 'Изображение',
            'image' => 'Изображение',
            'content' => 'Страница',
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

    public function getProducts()
    {
        return $this->hasMany(Product::className(), ['category_id' => 'category_id']);
    }

    public function getSubCategoriesList($id)
    {
        return $subCategories = SubCategory::find()
            ->where(['category_id' => $id])
            ->all();
    }

    public function getProductCount($categoryId, $subCategoryId)
    {
        return $count = Product::find()
            ->where(['category_id' => $categoryId])
            ->andWhere(['sub_category_id' => $subCategoryId])
            ->count();
    }

    /**
     * @param UploadedFile $file
     * @return string
     * @throws \yii\base\Exception
     */
    public function uploadImage(UploadedFile $file)
    {

        $this->deleteCurrentImage($this->image);

        $fileName = Yii::$app->security->generateRandomString(12);
        $filePath = self::BACKEND_PATH.$fileName.'.'.$file->extension;

        $file->saveAs($filePath);

        return $filePath;
    }

    /**
     * @param $filePath
     * @return bool
     */
    public function saveImage($filePath)
    {
        $this->image = $filePath;
        return $this->save(false);
    }

    /**
     * @param $image
     */
    public function deleteCurrentImage($image)
    {
        if (file_exists($image))
        {
            unlink($image);
        }
    }

    public function getCategoryByName($category)
    {
        return $category = Category::findOne(['url' => $category]);
    }
}
