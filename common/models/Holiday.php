<?php

namespace common\models;

use Yii;
use yii\web\UploadedFile;

/**
 * This is the model class for table "holidays".
 *
 * @property int $holiday_id
 * @property string|null $title
 * @property string|null $image
 * @property string|null $description
 * @property string|null $content
 * @property string|null $date
 * @property string $url
 */
class Holiday extends \yii\db\ActiveRecord
{

    const BACKEND_PATH = 'image/holiday/';

    public $file;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'holiday';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['image', 'content'], 'string'],
            [['url'], 'required'],
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
            'holiday_id' => 'Код',
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
