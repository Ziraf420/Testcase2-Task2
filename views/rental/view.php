<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Rental $model */

$this->title = $model->rental_id;
$this->params['breadcrumbs'][] = ['label' => 'Rentals', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="rental-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'rental_id' => $model->rental_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'rental_id' => $model->rental_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'rental_id',
            'rental_date',
            'inventory_id',
            'customer_id',
            'return_date',
            'staff_id',
            'last_update',
        ],
    ]) ?>

</div>
