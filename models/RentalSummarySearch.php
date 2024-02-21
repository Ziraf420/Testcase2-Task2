<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\RentalSummary;

/**
 * RentalSummarySearch represents the model behind the search form of `app\models\RentalSummary`.
 */
class RentalSummarySearch extends RentalSummary
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'inventory_id', 'store_id', 'film_id', 'transaction_count'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = RentalSummary::find();

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
            'inventory_id' => $this->inventory_id,
            'store_id' => $this->store_id,
            'film_id' => $this->film_id,
            'transaction_count' => $this->transaction_count,
        ]);

        return $dataProvider;
    }
}
