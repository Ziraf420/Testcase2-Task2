<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "inventory".
 *
 * @property int $inventory_id
 * @property int $film_id
 * @property int $store_id
 * @property string $last_update
 *
 * @property Film $film
 * @property Rental[] $rentals
 * @property Store $store
 */
class Inventory extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'inventory';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['film_id', 'store_id'], 'required'],
            [['film_id', 'store_id'], 'integer'],
            [['last_update'], 'safe'],
            [['film_id'], 'exist', 'skipOnError' => true, 'targetClass' => Film::class, 'targetAttribute' => ['film_id' => 'film_id']],
            [['store_id'], 'exist', 'skipOnError' => true, 'targetClass' => Store::class, 'targetAttribute' => ['store_id' => 'store_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'inventory_id' => 'Inventory ID',
            'film_id' => 'Film ID',
            'store_id' => 'Store ID',
            'last_update' => 'Last Update',
        ];
    }

    /**
     * Gets query for [[Film]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFilm()
    {
        return $this->hasOne(Film::class, ['film_id' => 'film_id']);
    }

    /**
     * Gets query for [[Rentals]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRentals()
    {
        return $this->hasMany(Rental::class, ['inventory_id' => 'inventory_id']);
    }

    /**
     * Gets query for [[Store]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStore()
    {
        return $this->hasOne(Store::class, ['store_id' => 'store_id']);
    }
}
