<?php

use app\models\FilmCategory;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\FilmCategorySearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Film Categories';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="film-category-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Film Category', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'film_id',
            'category_id',
            'last_update',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, FilmCategory $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'film_id' => $model->film_id, 'category_id' => $model->category_id]);
                 }
            ],
        ],
    ]); ?>


</div>
