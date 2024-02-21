<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Rental $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="rental-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'rental_date')->textInput() ?>

    <?= $form->field($model, 'inventory_id')->textInput() ?>

    <?= $form->field($model, 'customer_id')->textInput() ?>

    <?= $form->field($model, 'return_date')->textInput() ?>

    <?= $form->field($model, 'staff_id')->textInput() ?>

    <?= $form->field($model, 'last_update')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
