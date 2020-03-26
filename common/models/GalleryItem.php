<?php

namespace common\models;

use Yii;
use yii\web\UploadedFile;

/**
 * This is the model class for table "gallery_item".
 *
 * @property int $gallery_item_id
 * @property int $gallery_id
 * @property string|null $title
 * @property string $content
 *
 * @property Gallery $gallery
 */
class GalleryItem extends \yii\db\ActiveRecord
{

    const BACKEND_PATH = 'image/gallery/items';

    public $file;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'gallery_item';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['gallery_id'], 'required'],
            [['gallery_id'], 'integer'],
            [['content'], 'string'],
            [['title'], 'string', 'max' => 255],
            [['gallery_id'], 'exist', 'skipOnError' => true, 'targetClass' => Gallery::className(), 'targetAttribute' => ['gallery_id' => 'gallery_id']],
            [['file'], 'file', 'extensions' => ['png', 'jpg', 'jpeg']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'gallery_item_id' => 'Код',
            'gallery_id' => 'Gallery ID',
            'title' => 'Наименование',
            'content' => 'Контент',
            'file' => 'Изображение',
        ];
    }

    /**
     * Gets query for [[Gallery]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGallery()
    {
        return $this->hasOne(Gallery::className(), ['gallery_id' => 'gallery_id']);
    }

    /**
     * @param UploadedFile $file
     * @return string
     * @throws \yii\base\Exception
     */
    public function uploadImage(UploadedFile $file)
    {

        $this->deleteCurrentImage($this->content);

        $fileName = Yii::$app->security->generateRandomString(12);
        $filePath = self::BACKEND_PATH.$fileName.'.'.$file->extension;

        $file->saveAs($filePath);

        return $filePath;
    }

    /**
     * @param $filePath
     * @return bool
     */
    public function saveContent($filePath)
    {
        $this->content = $filePath;
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
