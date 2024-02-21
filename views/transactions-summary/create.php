<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\TransactionsSummary $model */

$this->title = 'Create Transactions Summary';
$this->params['breadcrumbs'][] = ['label' => 'Transactions Summaries', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="transactions-summary-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
