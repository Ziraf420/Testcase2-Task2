<?php

use app\models\Language;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\LanguageSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Languages';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="language-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Language', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'language_id',
            'name',
            'last_update',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Language $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'language_id' => $model->language_id]);
                 }
            ],
        ],
    ]); ?>


</div>
