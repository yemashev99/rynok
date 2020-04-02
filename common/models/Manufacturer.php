<?php

namespace common\models;

use Yii;
use yii\web\UploadedFile;

/**
 * This is the model class for table "manufacturer".
 *
 * @property int $manufacturer_id
 * @property string $title
 * @property string|null $image
 * @property string $description
 * @property string $content
 * @property string|null $date
 * @property string $url
 */
class Manufacturer extends \yii\db\ActiveRecord
{

    const BACKEND_PATH = 'image/manufacturer/';

    public $file;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'manufacturer';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'description', 'url'], 'required'],
            [['image', 'description', 'content'], 'string'],
            [['title', 'date', 'url'], 'string', 'max' => 255],
            [['file'], 'file', 'extensions' => ['png', 'jpg', 'jpeg']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'manufacturer_id' => 'Код',
            'title' => 'Заголовок',
            'image' => 'Изображение',
            'description' => 'Описание',
            'content' => 'Контент',
            'date' => 'Дата',
            'url' => 'Ссылка',
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
