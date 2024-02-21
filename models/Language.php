<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "language".
 *
 * @property int $language_id
 * @property string $name
 * @property string $last_update
 *
 * @property Film[] $films
 * @property Film[] $films0
 */
class Language extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'language';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['last_update'], 'safe'],
            [['name'], 'string', 'max' => 20],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'language_id' => 'Language ID',
            'name' => 'Name',
            'last_update' => 'Last Update',
        ];
    }

    /**
     * Gets query for [[Films]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFilms()
    {
        return $this->hasMany(Film::class, ['language_id' => 'language_id']);
    }

    /**
     * Gets query for [[Films0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFilms0()
    {
        return $this->hasMany(Film::class, ['original_language_id' => 'language_id']);
    }
}
