<?php

use app\models\Actor;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\ActorSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Actors';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="actor-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Actor', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'actor_id',
            'first_name',
            'last_name',
            'last_update',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Actor $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'actor_id' => $model->actor_id]);
                 }
            ],
        ],
    ]); ?>


</div>
