<?php

namespace app\controllers;

use app\models\Actor;
use app\models\ActorSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ActorController implements the CRUD actions for Actor model.
 */
class ActorController extends Controller
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
     * Lists all Actor models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new ActorSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Actor model.
     * @param int $actor_id Actor ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($actor_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($actor_id),
        ]);
    }

    /**
     * Creates a new Actor model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Actor();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'actor_id' => $model->actor_id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Actor model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $actor_id Actor ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($actor_id)
    {
        $model = $this->findModel($actor_id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'actor_id' => $model->actor_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Actor model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $actor_id Actor ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($actor_id)
    {
        $this->findModel($actor_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Actor model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $actor_id Actor ID
     * @return Actor the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($actor_id)
    {
        if (($model = Actor::findOne(['actor_id' => $actor_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
