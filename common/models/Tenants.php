<?php

namespace common\models;

use Yii;
use yii\web\UploadedFile;

/**
 * This is the model class for table "tenants".
 *
 * @property int $tenants_id
 * @property string $title
 * @property string|null $image
 * @property string $description
 * @property string|null $content
 * @property string|null $date
 * @property string $url
 */
class Tenants extends \yii\db\ActiveRecord
{

    const BACKEND_PATH = 'image/tenants/';

    public $file;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tenants';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'description', 'url'], 'required'],
            [['image', 'content'], 'string'],
            [['title', 'description', 'date', 'url'], 'string', 'max' => 255],
            [['file'], 'file', 'extensions' => ['png', 'jpg', 'jpeg']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'tenants_id' => 'Код',
            'title' => 'Заголовок',
            'image' => 'Изображение',
            'description' => 'Описание',
            'content' => 'Контент',
            'date' => 'Дата',
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
