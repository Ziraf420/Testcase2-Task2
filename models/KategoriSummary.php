<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "rentalsummary".
 *
 * @property int $id
 * @property int $inventory_id
 * @property int $store_id
 * @property int $film_id
 * @property int $transaction_count
 */
class KategoriSummary extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'rentalsummary';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['inventory_id', 'store_id', 'film_id', 'transaction_count'], 'required'],
            [['inventory_id', 'store_id', 'film_id', 'transaction_count'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'inventory_id' => 'Inventory ID',
            'store_id' => 'Store ID',
            'film_id' => 'Film ID',
            'transaction_count' => 'Transaction Count',
        ];
    }
}
