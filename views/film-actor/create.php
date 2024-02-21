<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\FilmActor $model */

$this->title = 'Create Film Actor';
$this->params['breadcrumbs'][] = ['label' => 'Film Actors', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="film-actor-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
