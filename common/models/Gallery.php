<?php

namespace common\models;

use Yii;
use yii\web\UploadedFile;

/**
 * This is the model class for table "gallery".
 *
 * @property int $gallery_id
 * @property string $title
 * @property string|null $image
 * @property string|null $description
 * @property string|null $content
 * @property string $date
 * @property string $type
 * @property string $url
 */
class Gallery extends \yii\db\ActiveRecord
{

    const BACKEND_PATH = 'image/gallery/';

    public $file;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'gallery';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'date', 'type', 'url'], 'required'],
            [['image', 'content'], 'string'],
            [['title', 'description', 'date', 'type', 'url'], 'string', 'max' => 255],
            [['file'], 'file', 'extensions' => ['png', 'jpg', 'jpeg']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'gallery_id' => 'Код',
            'title' => 'Заголовок',
            'image' => 'Image',
            'description' => 'Описание',
            'content' => 'Страница',
            'date' => 'Дата',
            'type' => 'Тип',
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

    public function getGalleryItems()
    {
        return $this->hasMany(GalleryItem::className(), ['gallery_id' => 'gallery_id']);
    }
}
