<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\RentalSummary $model */

$this->title = 'Create Rental Summary';
$this->params['breadcrumbs'][] = ['label' => 'Rental Summaries', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rental-summary-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
