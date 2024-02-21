<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "film_actor".
 *
 * @property int $actor_id
 * @property int $film_id
 * @property string $last_update
 *
 * @property Actor $actor
 * @property Film $film
 */
class FilmActor extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'film_actor';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['actor_id', 'film_id'], 'required'],
            [['actor_id', 'film_id'], 'integer'],
            [['last_update'], 'safe'],
            [['actor_id', 'film_id'], 'unique', 'targetAttribute' => ['actor_id', 'film_id']],
            [['actor_id'], 'exist', 'skipOnError' => true, 'targetClass' => Actor::class, 'targetAttribute' => ['actor_id' => 'actor_id']],
            [['film_id'], 'exist', 'skipOnError' => true, 'targetClass' => Film::class, 'targetAttribute' => ['film_id' => 'film_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'actor_id' => 'Actor ID',
            'film_id' => 'Film ID',
            'last_update' => 'Last Update',
        ];
    }

    /**
     * Gets query for [[Actor]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getActor()
    {
        return $this->hasOne(Actor::class, ['actor_id' => 'actor_id']);
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
}
