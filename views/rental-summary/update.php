<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\RentalSummary $model */

$this->title = 'Update Rental Summary: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Rental Summaries', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="rental-summary-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
