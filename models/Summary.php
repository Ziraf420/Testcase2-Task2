<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "summary".
 *
 * @property int|null $customer_id
 * @property float|null $total_amount
 */
class Summary extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'summary';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['customer_id'], 'integer'],
            [['total_amount'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'customer_id' => 'Customer ID',
            'total_amount' => 'Total Amount',
        ];
    }
}
