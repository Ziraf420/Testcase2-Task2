<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "rental_summary".
 *
 * @property int $id
 * @property int $inventory_id
 * @property int $store_id
 * @property int $film_id
 * @property int $transaction_count
 */
class RentalSummary extends \yii\db\ActiveRecord
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

    public static function summarizeTransactionCountByInventoryStoreFilm()
    {
        $summary = [];

        $rentals = Rental::find()
            ->select(['rental.inventory_id', 'inventory.store_id', 'inventory.film_id', 'COUNT(*) AS transaction_count'])
            ->join('JOIN', 'inventory', 'rental.inventory_id = inventory.inventory_id')
            ->groupBy(['rental.inventory_id', 'inventory.store_id', 'inventory.film_id'])
            ->asArray()
            ->all();

        foreach ($rentals as $rental) {
            $inventoryId = $rental['inventory_id'];
            $storeId = $rental['store_id'];
            $filmId = $rental['film_id'];
            $transactionCount = $rental['transaction_count'];

            if (!isset($summary[$inventoryId][$storeId][$filmId])) {
                $summary[$inventoryId][$storeId][$filmId] = 0;
            }

            $summary[$inventoryId][$storeId][$filmId] += $transactionCount;
        }

        return $summary;
    }
}