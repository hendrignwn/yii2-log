<?php

namespace hendrignwn\log\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use hendrignwn\log\models\LogDetail;

/**
 * LogDetailSearch represents the model behind the search form about `hendrignwn\log\models\LogDetail`.
 */
class LogDetailSearch extends LogDetail
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'log_id'], 'integer'],
            [['field', 'old_value', 'new_value'], 'safe'],
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
        $query = LogDetail::find();

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
            'log_id' => $this->log_id,
        ]);

        $query->andFilterWhere(['like', 'field', $this->field])
            ->andFilterWhere(['like', 'old_value', $this->old_value])
            ->andFilterWhere(['like', 'new_value', $this->new_value]);

        return $dataProvider;
    }
}
