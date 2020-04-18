<?php

namespace common\models;

use common\models\Cart;
use Yii;
use yii\helpers\ArrayHelper;
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
 * @property int $count
 * @property string $measure
 * @property string $url
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
            [['category_id', 'title', 'price', 'measure', 'url'], 'required'],
            [['category_id', 'sub_category_id', 'price'], 'integer'],
            [['count'], 'double'],
            [['description', 'image', 'url'], 'string'],
            ['url', 'unique', 'targetClass' => 'common\models\Product'],
            [['title', 'measure'], 'string', 'max' => 255],
            [['file'], 'file', 'extensions' => ['png', 'jpg', 'jpeg']],
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
            'count' => 'Кол-во',
            'measure' => 'Ед. измерения',
            'file' => 'Изображение',
            'url' => 'Ссылка',
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

    public static function searchItem()
    {
        $products = Product::find()->all();
        foreach ($products as $product)
        {
            $items[] = $product->title;
        }
        return $items;
    }

    public function getCart()
    {
        return $this->hasOne(Cart::className(), ['product_id' => 'product_id']);
    }

    public static function inCart($customer_id, $product_id)
    {
        $cartItem = Cart::find()->where(['customer_id' => $customer_id, 'product_id' => $product_id])->orderBy(['cart_id' => SORT_DESC])->one();
        if (is_null($cartItem) || $cartItem->order_status_id != 1){
            return true;
        } else {
            return false;
        }
    }

    public static function translit($str) {
    $rus = array('А', 'Б', 'В', 'Г', 'Д', 'Е', 'Ё', 'Ж', 'З', 'И', 'Й', 'К', 'Л', 'М', 'Н', 'О', 'П', 'Р', 'С', 'Т', 'У', 'Ф', 'Х', 'Ц', 'Ч', 'Ш', 'Щ', 'Ъ', 'Ы', 'Ь', 'Э', 'Ю', 'Я', 'а', 'б', 'в', 'г', 'д', 'е', 'ё', 'ж', 'з', 'и', 'й', 'к', 'л', 'м', 'н', 'о', 'п', 'р', 'с', 'т', 'у', 'ф', 'х', 'ц', 'ч', 'ш', 'щ', 'ъ', 'ы', 'ь', 'э', 'ю', 'я', ' ', ',');
    $lat = array('a', 'b', 'v', 'g', 'd', 'e', 'e', 'gh', 'z', 'i', 'y', 'k', 'l', 'm', 'n', 'o', 'p', 'r', 's', 't', 'u', 'f', 'h', 'c', 'ch', 'sh', 'sch', 'y', 'y', 'y', 'e', 'yu', 'ya', 'a', 'b', 'v', 'g', 'd', 'e', 'e', 'gh', 'z', 'i', 'y', 'k', 'l', 'm', 'n', 'o', 'p', 'r', 's', 't', 'u', 'f', 'h', 'c', 'ch', 'sh', 'sch', 'y', 'y', 'y', 'e', 'yu', 'ya', '-', '');
    return str_replace($rus, $lat, $str);
  }
}
