<?php


namespace backend\models;


use common\models\Cart;
use common\models\SubCategory;
use yii\base\Model;

class Export1C extends Model
{

    private $file_products = 'export/import.xml';
    private $file_orders = 'export/offers.xml';

    public function export($products, $orders)
    {
        if ($this->createFile($products, $orders))
        {
            if ($orders)
            {
                if (file_exists($this->file_orders)) {
                    return \Yii::$app->response->sendFile($this->file_orders);
                }
                throw new \Exception('File not found');
            } else {
                if (file_exists($this->file_products)) {
                    return \Yii::$app->response->sendFile($this->file_products);
                }
                throw new \Exception('File not found');
            }
        }
    }

    private function createFile($products, $orders)
    {
        $this->writeToFile($this->file_products, $this->createProductText($products));
        if (!is_null($orders))
        {
            $this->writeToFile($this->file_orders, $this->createOrderText($orders));
        }
        return true;
    }

    private function writeToFile($name, $content)
    {
        $fp = fopen($name, "w");
        fwrite($fp, $content);
        fclose($fp);
    }

    private function createProductText($products)
    {
        $text = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>
<КоммерческаяИнформация xmlns=\"urn:1C.ru:commerceml_210\" xmlns:xs=\"http://www.w3.org/2001/XMLSchema\" xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\" ВерсияСхемы=\"2.08\" ДатаФормирования=\"".date('Y-m-d')."T".date('H:i:s', $this->setTime())."\">
<Каталог>
<Товары>
";
        foreach ($products as $product)
        {
            $text.= "<Товар>
<Ид>".$product->product_id."</Ид>
<Категория>".$product->category->title."</Категория>
<Подкатегория>".$this->getSubCategoryById($product->sub_category_id)."</Подкатегория>
<Наименование>".$product->title."</Наименование>
<Описание>".$product->description."</Описание>
<Картинка>".$product->image."</Картинка>
<Цена>".$product->price."</Цена>
<Величина>".$product->count."</Величина>
<ЕденицаИзмерения>".$product->measure."</ЕденицаИзмерения>
</Товар>
";
        }
        $text.= "</Товары>
</Каталог>
</КоммерческаяИнформация>";
        return $text;
    }

    private function createOrderText($orders)
    {
        $text = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>
<КоммерческаяИнформация xmlns=\"urn:1C.ru:commerceml_210\" xmlns:xs=\"http://www.w3.org/2001/XMLSchema\" xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\" ВерсияСхемы=\"2.08\" ДатаФормирования=\"".date('Y-m-d')."T".date('H:i:s', $this->setTime())."\">
<ПакетПредложений>
<Предложения>
";
        foreach ($orders as $order)
        {
            $text.= "<Предложение>
<Ид>$order->customer_id</Ид>
<ФИО>".$order->fio."</ФИО>
<Телефон>".$order->phone."</Телефон>
<Адрес>".$order->address."</Адрес>
<ДатаЗаказа>".date('j.m.Y H:i:s', $order->cart->created_at)."</ДатаЗаказа>
<Товары>";
            foreach ($this->getCartItems($order->customer_id) as $item)
            {
                $text.= "<Товар>
<Наименование>".$item->product->title."</Наименование>
<Картинка>".$item->product->image."</Картинка>
<Комментарий>".$item->comment."</Комментарий>
<Количество>".$item->quantity."</Количество>
<Величина>".$item->product->count."</Величина>
<ЕденицаИзмерения>".$item->product->measure."</ЕденицаИзмерения>
<Сумма>".$item->product->price * $item->quantity."</Сумма>
</Товар>";
            }
            $text.= "</Товары>
</Предложение>";
        }
        $text.= "</Предложения>
</ПакетПредложений>
</КоммерческаяИнформация>";
        return $text;
    }

    private function setTime()
    {
        date_default_timezone_set("UTC");
        $time = time();
        $time += 7 * 3600;
        return $time;
    }

    private function getSubCategoryById($sub_category_id)
    {
        if ($sub_category_id)
        {
            $subCategory = SubCategory::findOne(['sub_category_id' => $sub_category_id]);
            return $subCategory->title;
        } else {
            return '';
        }
    }

    private function getCartItems($id)
    {
        return Cart::find()->where(['customer_id' => $id, 'order_status_id' => 2])->all();
    }
}