<?php

use app\models\TransactionsSummary;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\TransactionsSummarySearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Transactions Summaries';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="transactions-summary-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Transactions Summary', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'inventory_id',
            'store_id',
            'film_id',
            'total_transactions',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, TransactionsSummary $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
