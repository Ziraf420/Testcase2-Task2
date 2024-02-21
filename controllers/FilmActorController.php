<?php

namespace app\controllers;

use app\models\FilmActor;
use app\models\FilmActorSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * FilmActorController implements the CRUD actions for FilmActor model.
 */
class FilmActorController extends Controller
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
     * Lists all FilmActor models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new FilmActorSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single FilmActor model.
     * @param int $actor_id Actor ID
     * @param int $film_id Film ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($actor_id, $film_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($actor_id, $film_id),
        ]);
    }

    /**
     * Creates a new FilmActor model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new FilmActor();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'actor_id' => $model->actor_id, 'film_id' => $model->film_id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing FilmActor model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $actor_id Actor ID
     * @param int $film_id Film ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($actor_id, $film_id)
    {
        $model = $this->findModel($actor_id, $film_id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'actor_id' => $model->actor_id, 'film_id' => $model->film_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing FilmActor model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $actor_id Actor ID
     * @param int $film_id Film ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($actor_id, $film_id)
    {
        $this->findModel($actor_id, $film_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the FilmActor model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $actor_id Actor ID
     * @param int $film_id Film ID
     * @return FilmActor the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($actor_id, $film_id)
    {
        if (($model = FilmActor::findOne(['actor_id' => $actor_id, 'film_id' => $film_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
