<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "rental".
 *
 * @property int $rental_id
 * @property string $rental_date
 * @property int $inventory_id
 * @property int $customer_id
 * @property string|null $return_date
 * @property int $staff_id
 * @property string $last_update
 *
 * @property Customer $customer
 * @property Inventory $inventory
 * @property Payment[] $payments
 * @property Staff $staff
 */
class Rental extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'rental';
    }   
    public function relations()
    {
        
    } 
    public static function getTransactionCountSummarized()
    {
    $summary = [];

    $rentals = Rental::find()
        ->select(['inventory_id', 'store_id', 'film_id', 'COUNT(*) AS transaction_count'])
        ->joinWith('store')
        ->groupBy(['inventory_id', 'store_id', 'film_id'])
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
    public static function summarizeTransactionCountByInventoryStoreFilm()
    {
    $summary = [];

    $rentals = Rental::find()
        ->select(['inventory_id', 'store_id', 'film_id', 'COUNT(*) AS transaction_count'])
        ->groupBy(['inventory_id', 'store_id', 'film_id'])
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

        public function getStore()
        {
        return $this->hasOne(\app\models\Store::class, ['store_id' => 'store_id']);
        }


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['rental_date', 'inventory_id', 'customer_id', 'staff_id'], 'required'],
            [['rental_date', 'return_date', 'last_update'], 'safe'],
            [['inventory_id', 'customer_id', 'staff_id'], 'integer'],
            [['rental_date', 'inventory_id', 'customer_id'], 'unique', 'targetAttribute' => ['rental_date', 'inventory_id', 'customer_id']],
            [['customer_id'], 'exist', 'skipOnError' => true, 'targetClass' => Customer::class, 'targetAttribute' => ['customer_id' => 'customer_id']],
            [['inventory_id'], 'exist', 'skipOnError' => true, 'targetClass' => Inventory::class, 'targetAttribute' => ['inventory_id' => 'inventory_id']],
            [['staff_id'], 'exist', 'skipOnError' => true, 'targetClass' => Staff::class, 'targetAttribute' => ['staff_id' => 'staff_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'rental_id' => 'Rental ID',
            'rental_date' => 'Rental Date',
            'inventory_id' => 'Inventory ID',
            'customer_id' => 'Customer ID',
            'return_date' => 'Return Date',
            'staff_id' => 'Staff ID',
            'last_update' => 'Last Update',
        ];
    }
    

    /**
     * Gets query for [[Customer]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCustomer()
    {
        return $this->hasOne(Customer::class, ['customer_id' => 'customer_id']);
    }

    /**
     * Gets query for [[Inventory]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getInventory()
    {
        return $this->hasOne(Inventory::class, ['inventory_id' => 'inventory_id']);
    }

    /**
     * Gets query for [[Payments]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPayments()
    {
        return $this->hasMany(Payment::class, ['rental_id' => 'rental_id']);
    }

    /**
     * Gets query for [[Staff]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStaff()
    {
        return $this->hasOne(Staff::class, ['staff_id' => 'staff_id']);
    }
}
