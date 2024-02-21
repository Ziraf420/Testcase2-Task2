<?php
use app\models\RentalSummary;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use miloschuman\highcharts\Highcharts;

/** @var yii\web\View $this */
/** @var app\models\RentalSummarySearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Rental Summary Chart';
$this->params['breadcrumbs'][] = $this->title;

// Ambil data rangkaian transaksi berdasarkan inventory_id, store_id dan film_id dari model
$summary = RentalSummary::summarizeTransactionCountByInventoryStoreFilm();
?>

<div class="summary-chart">
    <h1><?= $this->title ?></h1>
    <?= Highcharts::widget([
        'options' => [
            'title' => ['text' => 'Top 10 Rental Summary'],
            'xAxis' => [
                'type' => 'category',
            ],
            'yAxis' => [
                'title' => ['text' => 'Number of Transactions'],
            ],
            'series' => [
                [
                    'type' => 'bar',
                    'name' => 'Transactions',
                    'data' => $summary, // Menggunakan $summary di sini
                ],
            ],
        ],
    ]); ?>
</div>