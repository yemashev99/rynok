<?php


namespace backend\models;


use common\models\News;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;

class NewsSearch extends Model
{
    public $title;
    public $description;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return ArrayHelper::merge(parent::rules(), [
            [['title', 'description'],'string'],
        ]);
    }

    /**
     * @param $params
     * @param null $id
     * @return ActiveDataProvider
     */
    public function search($params)
    {

        $query = News::find();

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

        $query->andFilterWhere(['LIKE', 'title', $this->title]);
        $query->andFilterWhere(['LIKE', 'description', $this->description]);

        return $dataProvider;
    }
}