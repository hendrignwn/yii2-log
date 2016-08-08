<?php

namespace hendrignwn\log\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use hendrignwn\log\models\LogModel;

/**
 * LogModelSearch represents the model behind the search form about `hendrignwn\log\models\LogModel`.
 */
class LogModelSearch extends LogModel
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'loggable'], 'integer'],
            [['model_name'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = LogModel::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'loggable' => $this->loggable,
        ]);

        $query->andFilterWhere(['like', 'model_name', $this->model_name]);
		
		$query->addOrderBy(['model_name'=>SORT_ASC]);

        return $dataProvider;
    }
}
