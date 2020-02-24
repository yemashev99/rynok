<?php

namespace common\models;

use Yii;
use yii\web\UploadedFile;

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

    const BACKEND_PATH = 'image/product/';

    public $file;

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
            [['category_id', 'title', 'price', 'measure'], 'required'],
            [['category_id', 'sub_category_id', 'price'], 'integer'],
            [['description', 'image'], 'string'],
            [['title', 'measure'], 'string', 'max' => 255],
            [['file'], 'file', 'extensions' => ['png', 'jpg']],
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
            'file' => 'Изображение',
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
