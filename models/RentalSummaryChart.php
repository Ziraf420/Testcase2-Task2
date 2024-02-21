<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

class RentalSummaryChart extends ActiveRecord
{
    public static function tableName()
    {
        return 'rental_summary_chart';
    }

    public function attributes()
    {
        return [
            'inventory_id',
            'store_id',
            'film_id',
            'transaction_count',
        ];
    }

    public function rules(): array
    {
        return [
            [['inventory_id', 'store_id', 'film_id', 'transaction_count'], 'integer'],
        ];
    }
}