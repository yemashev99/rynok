<?php


namespace backend\models;


use common\models\Cart;
use common\models\Product;
use common\models\SubCategory;
use yii\base\Model;

class Export1C extends Model
{

    private $file_products = 'export/import.xml';
    private $file_orders = 'export/offers.xml';

    public function export($products, $orders, $categories)
    {
        if ($this->createFile($products, $orders, $categories))
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

    private function createFile($products, $orders, $categories)
    {
        $this->writeToFile($this->file_products, $this->createProductText($products, $categories));
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

    private function createProductText($products, $categories)
    {
        $text = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>
<КоммерческаяИнформация xmlns=\"urn:1C.ru:commerceml_210\" xmlns:xs=\"http://www.w3.org/2001/XMLSchema\" xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\" ВерсияСхемы=\"2.08\" ДатаФормирования=\"".date('Y-m-d')."T".date('H:i:s', $this->setTime())."\">
<Классификатор>
<Ид>e3d2eef6-7a31-4984-ba2b-a92045ae066f</Ид>
<Наименование>Классификатор (Основной каталог товаров)</Наименование>
<Владелец>
<Ид>114a9041-2f82-11e7-91a5-001e8c7b3dfd</Ид>
<Наименование>ИП Маурер И. В.</Наименование>
<ИНН>246201145512</ИНН>
<ПолноеНаименование>ИП Маурер Ирина Викторовна</ПолноеНаименование>
</Владелец>
<Группы>";
        foreach ($categories as $category)
        {
            $text.= "<Группа>
<Ид>".$category->category_id."</Ид>
<Наименование>".$category->title."</Наименование>
<Группы>";
        foreach (SubCategory::getSubCategoryByCategoryId($category->category_id) as $subCategory)
        {
            $text.= "<Группа>
<Ид>".$subCategory->sub_category_id."</Ид>
<Наименование>".$subCategory->title."</Наименование>
</Группа>";
        }
            $text.= "</Группы>
</Группа>";
        }
        $text.= "</Группы>
</Классификатор>
<Каталог СодержитТолькоИзменения=\"false\">
<Ид>e3d2eef6-7a31-4984-ba2b-a92045ae066f</Ид>
<ИдКлассификатора>e3d2eef6-7a31-4984-ba2b-a92045ae066f</ИдКлассификатора>
<Наименование>Основной каталог товаров</Наименование>
<Владелец>
<Ид>114a9041-2f82-11e7-91a5-001e8c7b3dfd</Ид>
<Наименование>ИП Маурер И. В.</Наименование>
<ИНН>246201145512</ИНН>
<ПолноеНаименование>ИП Маурер Ирина Викторовна</ПолноеНаименование>
</Владелец>
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
<ЕдиницаИзмерения>".$product->measure."</ЕдиницаИзмерения>
<Группа>
<Ид>$product->category_id</Ид>
</Группа>
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
";
        foreach ($orders as $order)
        {
            $text.="<Документ>
<Ид>".$order->order_id."</Ид>
<Номер>".$order->order_id."</Номер>
<Дата>".date('Y-m-d', $order->created_at)."</Дата>
<ХозОперация>Заказ товара</ХозОперация>
<Роль>Продавец</Роль>
<Валюта>руб</Валюта>
<Курс>1</Курс>
<Сумма>".Cart::cartPrice($order->customer->customer_id, 'admin', 'new', 'Y')."</Сумма>
<Контрагенты>
<Контрагент>
<Ид>".$order->customer->customer_id."</Ид>
<Наименование>".$order->customer->fio."</Наименование>
<ПолноеНаименование>".$order->customer->fio."</ПолноеНаименование>
<Роль>Покупатель</Роль>
</Контрагент>
</Контрагенты>
<Налоги>
<Налог>
<Наименование>НДС</Наименование>
<УчтеноВСумме>true</УчтеноВСумме>
<Cумма>0</Cумма>
</Налог>
</Налоги>
<Товары>";
            foreach (Cart::getCartItems($order->order_id) as $item)
            {
                $text.="<Товар>
<Ид>".$item->cart_id."</Ид>
<Артикул>".$item->cart_id."</Артикул>
<Наименование>".$item->product->title."</Наименование>
<БазоваяЕдиница Наименование=\"".$item->product->measure."\" НаименованиеПолное=\"".Product::getMeasure($item->product->measure)."\" />
<ЗначенияРеквизитов>
<ЗначениеРеквизита>
<Наименование>ВидНоменклатуры</Наименование>
<Значение>Товар</Значение>
</ЗначениеРеквизита>
<ЗначениеРеквизита>
<Наименование>ТипНоменклатуры</Наименование>
<Значение>Запас</Значение>
</ЗначениеРеквизита>
</ЗначенияРеквизитов>
<ЦенаЗаЕдиницу>".$item->product->price."</ЦенаЗаЕдиницу>
<Количество>".$item->quantity."</Количество>
<Сумма>".$item->quantity * $item->product->price."</Сумма>
<Единица>".$item->product->measure."</Единица>
<Коэффициент>".$item->product->count."</Коэффициент>
</Товар>";
            }
            $text.="</Товары></Документ>";
        }
        $text.="</КоммерческаяИнформация>";
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
