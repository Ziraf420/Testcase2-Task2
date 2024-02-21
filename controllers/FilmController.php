<?php

namespace app\controllers;

use app\models\Film;
use app\models\FilmSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * FilmController implements the CRUD actions for Film model.
 */
class FilmController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Film models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new FilmSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Film model.
     * @param int $film_id Film ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($film_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($film_id),
        ]);
    }

    /**
     * Creates a new Film model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Film();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'film_id' => $model->film_id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Film model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $film_id Film ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($film_id)
    {
        $model = $this->findModel($film_id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'film_id' => $model->film_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Film model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $film_id Film ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($film_id)
    {
        $this->findModel($film_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Film model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $film_id Film ID
     * @return Film the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($film_id)
    {
        if (($model = Film::findOne(['film_id' => $film_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
