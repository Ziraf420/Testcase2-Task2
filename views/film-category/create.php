<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\FilmCategory $model */

$this->title = 'Create Film Category';
$this->params['breadcrumbs'][] = ['label' => 'Film Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="film-category-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
