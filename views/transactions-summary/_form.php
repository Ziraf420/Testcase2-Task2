<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\TransactionsSummary $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="transactions-summary-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'inventory_id')->textInput() ?>

    <?= $form->field($model, 'store_id')->textInput() ?>

    <?= $form->field($model, 'film_id')->textInput() ?>

    <?= $form->field($model, 'total_transactions')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
