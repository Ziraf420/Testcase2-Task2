<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "actor".
 *
 * @property int $actor_id
 * @property string $first_name
 * @property string $last_name
 * @property string $last_update
 *
 * @property FilmActor[] $filmActors
 * @property Film[] $films
 */
class Actor extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'actor';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['first_name', 'last_name'], 'required'],
            [['last_update'], 'safe'],
            [['first_name', 'last_name'], 'string', 'max' => 45],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'actor_id' => 'Actor ID',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'last_update' => 'Last Update',
        ];
    }

    /**
     * Gets query for [[FilmActors]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFilmActors()
    {
        return $this->hasMany(FilmActor::class, ['actor_id' => 'actor_id']);
    }

    /**
     * Gets query for [[Films]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFilms()
    {
        return $this->hasMany(Film::class, ['film_id' => 'film_id'])->viaTable('film_actor', ['actor_id' => 'actor_id']);
    }
}
