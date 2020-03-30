<?php

namespace common\models;

use Yii;
use yii\web\UploadedFile;

/**
 * This is the model class for table "first_page_gallery".
 *
 * @property int $first_page_gallery_id
 * @property string $title
 * @property string $image
 * @property string $url
 */
class FirstPageGallery extends \yii\db\ActiveRecord
{

    const BACKEND_PATH = 'image/first/';

    public $file;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'first_page_gallery';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['image'], 'string'],
            [['sort'], 'integer'],
            [['title', 'url'], 'string', 'max' => 255],
            [['file'], 'file', 'extensions' => ['png', 'jpg', 'jpeg']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'first_page_gallery_id' => 'Код',
            'title' => 'Заголовок',
            'image' => 'Изображение',
            'url' => 'Ссылка',
            'file' => 'Изображение',
        ];
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
