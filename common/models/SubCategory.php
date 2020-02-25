<?php

namespace common\models;

use common\models\Category;
use Yii;
use yii\web\UploadedFile;

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

    const BACKEND_PATH = 'image/sub-category/';

    public $file;

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
            [['image'], 'string'],
            [['file'], 'file', 'extensions' => ['png', 'jpg']],
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
            'file' => 'Изображение',
            'image' => 'Изображение',
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
}
