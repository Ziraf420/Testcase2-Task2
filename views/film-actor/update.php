<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\FilmActor $model */

$this->title = 'Update Film Actor: ' . $model->actor_id;
$this->params['breadcrumbs'][] = ['label' => 'Film Actors', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->actor_id, 'url' => ['view', 'actor_id' => $model->actor_id, 'film_id' => $model->film_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="film-actor-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
