<?php


namespace backend\models;


use common\models\Customer;
use common\models\Order;
use common\models\OrderStatus;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;

class OrderSearch extends Model
{
    public $fio;
    public $phone;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return ArrayHelper::merge(parent::rules(), [
            [['fio', 'phone'],'string'],
        ]);
    }

    /**
     * @param $params
     * @param $status
     * @return ActiveDataProvider
     */
    public function search($params, $status)
    {
        $query = Order::find()->where(['order_status_id' => OrderStatus::getStatusIdByTitle($status)])->orderBy('created_at');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 11
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere(['LIKE', 'customer.fio', $this->fio]);
        $query->andFilterWhere(['LIKE', 'customer.phone', $this->phone]);

        return $dataProvider;
    }

    public static function orderCount($status)
    {
        return Order::find()->where(['order_status_id' => $status])->count();
    }
}