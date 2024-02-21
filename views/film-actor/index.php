<?php

use app\models\FilmActor;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\FilmActorSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Film Actors';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="film-actor-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Film Actor', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'actor_id',
            'film_id',
            'last_update',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, FilmActor $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'actor_id' => $model->actor_id, 'film_id' => $model->film_id]);
                 }
            ],
        ],
    ]); ?>


</div>
