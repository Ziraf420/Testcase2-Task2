<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\TransactionsSummary $model */

$this->title = 'Update Transactions Summary: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Transactions Summaries', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="transactions-summary-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
