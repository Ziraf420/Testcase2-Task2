<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Rental;

/**
 * RentalSearch represents the model behind the search form of `app\models\Rental`.
 */
class RentalSearch extends Rental
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['rental_id', 'inventory_id', 'customer_id', 'staff_id'], 'integer'],
            [['rental_date', 'return_date', 'last_update'], 'safe'],
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
        $query = Rental::find();

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
            'rental_id' => $this->rental_id,
            'rental_date' => $this->rental_date,
            'inventory_id' => $this->inventory_id,
            'customer_id' => $this->customer_id,
            'return_date' => $this->return_date,
            'staff_id' => $this->staff_id,
            'last_update' => $this->last_update,
        ]);

        return $dataProvider;
    }
}
