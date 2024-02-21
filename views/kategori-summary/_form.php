<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\KategoriSummary $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="kategori-summary-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'inventory_id')->textInput() ?>

    <?= $form->field($model, 'store_id')->textInput() ?>

    <?= $form->field($model, 'film_id')->textInput() ?>

    <?= $form->field($model, 'transaction_count')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
