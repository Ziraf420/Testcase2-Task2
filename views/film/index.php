<?php

use app\models\Film;
use yii\helpers\Html;
use miloschuman\highcharts\Highcharts;

/** @var yii\web\View $this */
/** @var app\models\FilmSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Films';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="film-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row">
        <div class="col-md-4">
            <?php
            $data = Yii::$app->db->createCommand("
               SELECT fc.category_id, c.name, COUNT(*) AS jumlah_sewa
        FROM film_category fc
        INNER JOIN category c ON fc.category_id = c.category_id
        GROUP BY fc.category_id
        ORDER BY jumlah_sewa DESC
        LIMIT 10
            ")->queryAll();

            $categories = [];
            $rentals = [];
            foreach ($data as $row) {
                $categories[] = $row['name'];
                $rentals[] = (int) $row['jumlah_sewa'];
            }

            echo Highcharts::widget([
                'options' => [
                    'title' => ['text' => 'Top 10 Categories by Rentals (Bar Chart)'],
                    'xAxis' => [
                        'categories' => $categories,
                    ],
                    'yAxis' => [
                        'title' => ['text' => 'Total Rentals'],
                    ],
                    'series' => [
                        ['name' => 'Total Rentals', 'data' => $rentals],
                    ],
                ],
            ]);
            ?>
        </div>
        <div class="col-md-4">
            <?php
            // Pie Chart
            echo Highcharts::widget([
                'options' => [
                    'title' => ['text' => 'Top 10 Categories by Rentals (Pie Chart)'],
                    'plotOptions' => [
                        'pie' => [
                            'allowPointSelect' => true,
                            'cursor' => 'pointer',
                            'dataLabels' => [
                                'enabled' => true,
                                'format' => '<b>{point.name}</b>: {point.percentage:.1f} %',
                            ],
                            'showInLegend' => true,
                        ],
                    ],
                    'series' => [
                        [
                            'type' => 'pie',
                            'name' => 'Total Rentals',
                            'data' => array_map(function($row) {
                                return ['Category ID: ' . $row['name'], (int)$row['jumlah_sewa']];
                            }, $data),
                        ],
                    ],
                ],
            ]);
            ?>
        </div>
        <div class="col-md-4">
            <?php
            // Column Chart
            echo Highcharts::widget([
                'options' => [
                    'title' => ['text' => 'Top 10 Categories by Rentals (Column Chart)'],
                    'xAxis' => [
                        'categories' => $categories,
                    ],
                    'yAxis' => [
                        'title' => ['text' => 'Total Rentals'],
                    ],
                    'series' => [
                        ['name' => 'Total Rentals', 'data' => $rentals],
                    ],
                ],
            ]);
            ?>
        </div>
    </div>

</div>