<?php


namespace backend\models;


use common\models\Callback;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;

class CallbackSearch extends Model
{

    public $name;
    public $phone;
    public $date;
    public $type;

    public function __construct($type, $config = [])
    {
        $this->type = $type;
        parent::__construct($config);
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return ArrayHelper::merge(parent::rules(), [
            [['name', 'phone', 'date'],'string'],
        ]);
    }

    /**
     * @param $params
     * @param null $id
     * @return ActiveDataProvider
     */
    public function search($params)
    {

        $query = Callback::find()->where(['type' => $this->type]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 11
            ],
            'sort' => [
                'defaultOrder' => ['callback_id' => SORT_DESC]
            ]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere(['LIKE', 'name', $this->name]);
        $query->andFilterWhere(['LIKE', 'phone', $this->phone]);
        $query->andFilterWhere(['LIKE', 'date', $this->date]);

        return $dataProvider;
    }
}