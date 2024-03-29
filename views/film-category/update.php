<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\FilmCategory $model */

$this->title = 'Update Film Category: ' . $model->film_id;
$this->params['breadcrumbs'][] = ['label' => 'Film Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->film_id, 'url' => ['view', 'film_id' => $model->film_id, 'category_id' => $model->category_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="film-category-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
