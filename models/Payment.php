<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "payment".
 *
 * @property int $payment_id
 * @property int $customer_id
 * @property int $staff_id
 * @property int|null $rental_id
 * @property float $amount
 * @property string $payment_date
 * @property string $last_update
 *
 * @property Customer $customer
 * @property Rental $rental
 * @property Staff $staff
 */
class Payment extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'payment';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['customer_id', 'staff_id', 'amount', 'payment_date'], 'required'],
            [['customer_id', 'staff_id', 'rental_id'], 'integer'],
            [['amount'], 'number'],
            [['payment_date', 'last_update'], 'safe'],
            [['customer_id'], 'exist', 'skipOnError' => true, 'targetClass' => Customer::class, 'targetAttribute' => ['customer_id' => 'customer_id']],
            [['rental_id'], 'exist', 'skipOnError' => true, 'targetClass' => Rental::class, 'targetAttribute' => ['rental_id' => 'rental_id']],
            [['staff_id'], 'exist', 'skipOnError' => true, 'targetClass' => Staff::class, 'targetAttribute' => ['staff_id' => 'staff_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'payment_id' => 'Payment ID',
            'customer_id' => 'Customer ID',
            'staff_id' => 'Staff ID',
            'rental_id' => 'Rental ID',
            'amount' => 'Amount',
            'payment_date' => 'Payment Date',
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
     * Gets query for [[Rental]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRental()
    {
        return $this->hasOne(Rental::class, ['rental_id' => 'rental_id']);
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

    /**
     * Summarize payments amount based on customer_id.
     *
     * @return array
     */
    public static function summarizeAmountByCustomerId()
    {
        $summary = [];

        $payments = self::find()->all();

        foreach ($payments as $payment) {
            $customerId = $payment->customer_id;
            $amount = $payment->amount;

            if (!isset($summary[$customerId])) {
                $summary[$customerId] = 0;
            }

            $summary[$customerId] += $amount;
        }

        return $summary;
    }
}