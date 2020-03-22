<?php

namespace common\models;

use Yii;
use yii\web\UploadedFile;

/**
 * This is the model class for table "news".
 *
 * @property int $news_id
 * @property string $title
 * @property string $image
 * @property string $description
 * @property string $content
 * @property string $url
 */
class News extends \yii\db\ActiveRecord
{

    const BACKEND_PATH = 'image/news/';

    public $file;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'news';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'description', 'url'], 'required'],
            [['description', 'content'], 'string'],
            [['title', 'image', 'url'], 'string', 'max' => 255],
            [['file'], 'file', 'extensions' => ['png', 'jpg', 'jpeg']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'news_id' => 'Код',
            'title' => 'Заголовок',
            'image' => 'Главное изображение',
            'description' => 'Описание',
            'content' => 'Контент',
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
