<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "store".
 *
 * @property int $store_id
 * @property int $manager_staff_id
 * @property int $address_id
 * @property string $last_update
 *
 * @property Address $address
 * @property Customer[] $customers
 * @property Inventory[] $inventories
 * @property Staff $managerStaff
 * @property Staff[] $staff
 */
class Store extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'store';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['manager_staff_id', 'address_id'], 'required'],
            [['manager_staff_id', 'address_id'], 'integer'],
            [['last_update'], 'safe'],
            [['manager_staff_id'], 'unique'],
            [['address_id'], 'exist', 'skipOnError' => true, 'targetClass' => Address::class, 'targetAttribute' => ['address_id' => 'address_id']],
            [['manager_staff_id'], 'exist', 'skipOnError' => true, 'targetClass' => Staff::class, 'targetAttribute' => ['manager_staff_id' => 'staff_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'store_id' => 'Store ID',
            'manager_staff_id' => 'Manager Staff ID',
            'address_id' => 'Address ID',
            'last_update' => 'Last Update',
        ];
    }

    /**
     * Gets query for [[Address]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAddress()
    {
        return $this->hasOne(Address::class, ['address_id' => 'address_id']);
    }

    /**
     * Gets query for [[Customers]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCustomers()
    {
        return $this->hasMany(Customer::class, ['store_id' => 'store_id']);
    }

    /**
     * Gets query for [[Inventories]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getInventories()
    {
        return $this->hasMany(Inventory::class, ['store_id' => 'store_id']);
    }

    /**
     * Gets query for [[ManagerStaff]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getManagerStaff()
    {
        return $this->hasOne(Staff::class, ['staff_id' => 'manager_staff_id']);
    }

    /**
     * Gets query for [[Staff]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStaff()
    {
        return $this->hasMany(Staff::class, ['store_id' => 'store_id']);
    }
}
