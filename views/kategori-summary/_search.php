<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\KategoriSummarySearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="kategori-summary-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'inventory_id') ?>

    <?= $form->field($model, 'store_id') ?>

    <?= $form->field($model, 'film_id') ?>

    <?= $form->field($model, 'transaction_count') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
