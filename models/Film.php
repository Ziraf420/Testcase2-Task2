<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "film".
 *
 * @property int $film_id
 * @property string $title
 * @property string|null $description
 * @property string|null $release_year
 * @property int $language_id
 * @property int|null $original_language_id
 * @property int $rental_duration
 * @property float $rental_rate
 * @property int|null $length
 * @property float $replacement_cost
 * @property string|null $rating
 * @property string|null $special_features
 * @property string $last_update
 *
 * @property Actor[] $actors
 * @property Category[] $categories
 * @property FilmActor[] $filmActors
 * @property FilmCategory[] $filmCategories
 * @property Inventory[] $inventories
 * @property Language $language
 * @property Language $originalLanguage
 * @property RentalSummary[] $rentalSummaries
 */
class Film extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'film';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'language_id'], 'required'],
            [['description', 'rating', 'special_features'], 'string'],
            [['release_year', 'last_update'], 'safe'],
            [['language_id', 'original_language_id', 'rental_duration', 'length'], 'integer'],
            [['rental_rate', 'replacement_cost'], 'number'],
            [['title'], 'string', 'max' => 255],
            [['language_id'], 'exist', 'skipOnError' => true, 'targetClass' => Language::class, 'targetAttribute' => ['language_id' => 'language_id']],
            [['original_language_id'], 'exist', 'skipOnError' => true, 'targetClass' => Language::class, 'targetAttribute' => ['original_language_id' => 'language_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'film_id' => 'Film ID',
            'title' => 'Title',
            'description' => 'Description',
            'release_year' => 'Release Year',
            'language_id' => 'Language ID',
            'original_language_id' => 'Original Language ID',
            'rental_duration' => 'Rental Duration',
            'rental_rate' => 'Rental Rate',
            'length' => 'Length',
            'replacement_cost' => 'Replacement Cost',
            'rating' => 'Rating',
            'special_features' => 'Special Features',
            'last_update' => 'Last Update',
        ];
    }

    /**
     * Gets query for [[Actors]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getActors()
    {
        return $this->hasMany(Actor::class, ['actor_id' => 'actor_id'])->viaTable('film_actor', ['film_id' => 'film_id']);
    }

    /**
     * Gets query for [[Categories]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategories()
    {
        return $this->hasMany(Category::class, ['category_id' => 'category_id'])->viaTable('film_category', ['film_id' => 'film_id']);
    }

    /**
     * Gets query for [[FilmActors]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFilmActors()
    {
        return $this->hasMany(FilmActor::class, ['film_id' => 'film_id']);
    }

    /**
     * Gets query for [[FilmCategories]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFilmCategories()
    {
        return $this->hasMany(FilmCategory::class, ['film_id' => 'film_id']);
    }

    /**
     * Gets query for [[Inventories]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getInventories()
    {
        return $this->hasMany(Inventory::class, ['film_id' => 'film_id']);
    }

    /**
     * Gets query for [[Language]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLanguage()
    {
        return $this->hasOne(Language::class, ['language_id' => 'language_id']);
    }

    /**
     * Gets query for [[OriginalLanguage]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOriginalLanguage()
    {
        return $this->hasOne(Language::class, ['language_id' => 'original_language_id']);
    }

    /**
     * Gets query for [[RentalSummaries]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRentalSummaries()
    {
        return $this->hasMany(RentalSummary::class, ['film_id' => 'film_id']);
    }
}