<?php

use app\models\Payment;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use miloschuman\highcharts\Highcharts;

/** @var yii\web\View $this */
/** @var app\models\PaymentSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Payments';
$this->params['breadcrumbs'][] = $this->title;

// Ambil data ringkasan jumlah amount berdasarkan customer ID dari model atau query
$summaryData = Payment::find()
    ->select(['customer_id', 'SUM(amount) as total_amount'])
    ->groupBy('customer_id')
    ->asArray()
    ->all();

// Urutkan data berdasarkan total amount secara descending
usort($summaryData, function($a, $b) {
    return $b['total_amount'] - $a['total_amount'];
});

// Ambil hanya 10 data pertama (top 10)
$summaryData = array_slice($summaryData, 0, 10);

// Siapkan data untuk chart
$chartData = [];
foreach ($summaryData as $data) {
    $chartData[] = [
        'name' => 'Customer ID ' . $data['customer_id'],
        'y' => (float) $data['total_amount'], // Pastikan jumlah amount sudah diubah ke tipe float jika diperlukan
    ];
}
?>

<div class="summary-chart">
    <h1><?= $this->title ?></h1>
    <?= Highcharts::widget([
        'options' => [
            'title' => ['text' => 'Summary of Amount by Customer ID'],
            'xAxis' => [
                'type' => 'category',
            ],
            'yAxis' => [
                'title' => ['text' => 'Total Amount'],
            ],
            'series' => [
                [
                    'type' => 'column',
                    'name' => 'Amount',
                    'data' => $chartData,
                ],
            ],
        ],
    ]); ?>
</div>