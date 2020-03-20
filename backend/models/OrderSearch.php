<?php


namespace backend\models;


use common\models\Customer;
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
     * @param null $id
     * @return ActiveDataProvider
     */
    public function search($params, $status)
    {
        $query = Customer::find()
            ->join("INNER JOIN", "cart", "cart.customer_id = customer.customer_id");

        switch ($status){
            case 'new':
                $query = $query->where('cart.order_status_id = 2');
                break;
            case 'delivered':
                $query = $query->where('cart.order_status_id = 3');
                break;
            case 'done':
                $query = $query->where('cart.order_status_id = 4');
                break;
        }

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

        $query->andFilterWhere(['LIKE', 'fio', $this->fio]);
        $query->andFilterWhere(['LIKE', 'phone', $this->phone]);

        return $dataProvider;
    }

    public static function orderCount($status)
    {
        $query = Customer::find()
            ->join("INNER JOIN", "cart", "cart.customer_id = customer.customer_id");

        switch ($status){
            case 'new':
                $query = $query->where('cart.order_status_id = 2');
                break;
            case 'delivered':
                $query = $query->where('cart.order_status_id = 3');
                break;
            case 'done':
                $query = $query->where('cart.order_status_id = 4');
                break;
        }
        $count = $query->groupBy('fio')->count();
        return $count;
    }
}