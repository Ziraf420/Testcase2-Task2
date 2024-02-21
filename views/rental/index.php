<?php

use app\models\Rental;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\RentalSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Rentals';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rental-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Rental', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'rental_id',
            'rental_date',
            'inventory_id',
            'customer_id',
            'return_date',
            //'staff_id',
            //'last_update',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Rental $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'rental_id' => $model->rental_id]);
                 }
            ],
        ],
    ]); ?>


</div>
