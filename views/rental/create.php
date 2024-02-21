<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Rental $model */

$this->title = 'Create Rental';
$this->params['breadcrumbs'][] = ['label' => 'Rentals', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rental-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
