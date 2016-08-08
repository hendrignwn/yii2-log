<?php

namespace hendrignwn\log\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use hendrignwn\log\models\Log;

/**
 * LogSearch represents the model behind the search form about `common\models\Log`.
 */
class LogSearch extends Log
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['current_url', 'ip_address', 'model', 'model_id', 'old_attributes', 'new_attributes', 'scenario', 'created_at', 'created_by'], 'safe'],
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
        $query = Log::find();

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
            'created_at' => $this->created_at,
        ]);

        $query->andFilterWhere(['like', 'current_url', $this->current_url])
            ->andFilterWhere(['like', 'ip_address', $this->ip_address])
            ->andFilterWhere(['like', 'model', $this->model])
            ->andFilterWhere(['like', 'model_id', $this->model_id])
            ->andFilterWhere(['like', 'old_attributes', $this->old_attributes])
            ->andFilterWhere(['like', 'new_attributes', $this->new_attributes])
            ->andFilterWhere(['like', 'scenario', $this->scenario])
            ->andFilterWhere(['like', 'created_by', $this->created_by]);
		
		$query->addOrderBy(['created_at'=>SORT_DESC]);

        return $dataProvider;
    }
}
