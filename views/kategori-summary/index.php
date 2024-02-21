<?php
use app\models\KategoriSummary;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use miloschuman\highcharts\Highcharts;

/** @var yii\web\View $this */
/** @var app\models\KategoriSummarySearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Kategori Summaries';
$this->params['breadcrumbs'][] = $this->title;

// Ambil data rangkaian transaksi berdasarkan categori_id dari model atau query
$summaryData = KategoriSummary::find()
    ->select(['categori_id', 'SUM(transaction_count) as total_transactions'])
    ->groupBy(['categori_id'])
    ->orderBy(['total_transactions' => SORT_DESC])
    ->limit(10)
    ->asArray()
    ->all();

// Buat daftar nama dan jumlah transaksi untuk chart
$chartData = [];
foreach ($summaryData as $data) {
    $chartData[] = [
        'name' => Html::encode("Kategori ID {$data['categori_id']}") . ' Transactions',
        'y' => (int) $data['total_transactions'],
    ];
}
?>

<div class="kategori-summary-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Kategori Summary', ['create'], ['class' => 'btn btn-success']) ?>
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
            'categori_id',
            'transaction_count',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, KategoriSummary $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>

    <div class="summary-chart">
        <?= Highcharts::widget([
            'options' => [
                'title' => ['text' => 'Top 10 Kategori Tersewa'],
                'xAxis' => [
                    'type' => 'category',
                ],
                'yAxis' => [
                    'title' => ['text' => 'Jumlah Transaksi'],
                ],
                'series' => [
                    [
                        'type' => 'bar',
                        'name' => 'Transaksi',
                        'data' => $chartData,
                    ],
                ],
            ],
        ]); ?>
    </div>

</div>