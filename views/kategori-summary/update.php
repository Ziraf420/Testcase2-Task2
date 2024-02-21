<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\KategoriSummary $model */

$this->title = 'Update Kategori Summary: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Kategori Summaries', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="kategori-summary-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
