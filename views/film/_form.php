<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Film $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="film-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'release_year')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'language_id')->textInput() ?>

    <?= $form->field($model, 'original_language_id')->textInput() ?>

    <?= $form->field($model, 'rental_duration')->textInput() ?>

    <?= $form->field($model, 'rental_rate')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'length')->textInput() ?>

    <?= $form->field($model, 'replacement_cost')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'rating')->dropDownList([ 'G' => 'G', 'PG' => 'PG', 'PG-13' => 'PG-13', 'R' => 'R', 'NC-17' => 'NC-17', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'special_features')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'last_update')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
