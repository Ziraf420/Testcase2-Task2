<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\KategoriSummary $model */

$this->title = 'Create Kategori Summary';
$this->params['breadcrumbs'][] = ['label' => 'Kategori Summaries', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kategori-summary-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
