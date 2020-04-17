<?php

namespace common\models;

use Yii;
use yii\web\UploadedFile;

/**
 * This is the model class for table "tenants_doc".
 *
 * @property int $doc_id
 * @property string $title
 * @property string|null $doc
 */
class TenantsDoc extends \yii\db\ActiveRecord
{

    const BACKEND_PATH = 'documents/tenants/';

    public $file;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tenants_doc';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['doc'], 'string'],
            [['title'], 'string', 'max' => 255],
            [['file'], 'file', 'extensions' => ['pdf', 'doc', 'docx']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'doc_id' => 'Код',
            'title' => 'Наименование',
            'doc' => 'Документ',
            'file' => 'Документ'
        ];
    }

    /**
     * @param UploadedFile $file
     * @return string
     * @throws \yii\base\Exception
     */
    public function uploadFile(UploadedFile $file)
    {

        $this->deleteCurrentFile($this->doc);

        $fileName = Yii::$app->security->generateRandomString(12);
        $filePath = self::BACKEND_PATH.$fileName.'.'.$file->extension;

        $file->saveAs($filePath);

        return $filePath;
    }

    /**
     * @param $filePath
     * @return bool
     */
    public function saveFile($filePath)
    {
        $this->doc = $filePath;
        return $this->save(false);
    }

    /**
     * @param $image
     */
    public function deleteCurrentFile($doc)
    {
        if (file_exists($doc))
        {
            unlink($doc);
        }
    }
}
