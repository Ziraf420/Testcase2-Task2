<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\FilmActor $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="film-actor-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'actor_id')->textInput() ?>

    <?= $form->field($model, 'film_id')->textInput() ?>

    <?= $form->field($model, 'last_update')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
