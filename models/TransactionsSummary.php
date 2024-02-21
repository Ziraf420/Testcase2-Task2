<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "transactions_summary".
 *
 * @property int $id
 * @property int $inventory_id
 * @property int $store_id
 * @property int $film_id
 * @property int $total_transactions
 */
class TransactionsSummary extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'transactions_summary';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['inventory_id', 'store_id', 'film_id', 'total_transactions'], 'required'],
            [['inventory_id', 'store_id', 'film_id', 'total_transactions'], 'integer'],
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
            'total_transactions' => 'Total Transactions',
        ];
    }
}
