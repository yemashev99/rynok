<?php


namespace backend\models;


use common\models\Gallery;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;

class GallerySearch extends Model
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

        $query = Gallery::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 11
            ],
            'sort' => [
                'defaultOrder' => ['gallery_id' => SORT_DESC]
            ]
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