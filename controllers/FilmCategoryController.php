<?php

namespace app\controllers;

use app\models\FilmCategory;
use app\models\FilmCategorySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * FilmCategoryController implements the CRUD actions for FilmCategory model.
 */
class FilmCategoryController extends Controller
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
     * Lists all FilmCategory models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new FilmCategorySearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single FilmCategory model.
     * @param int $film_id Film ID
     * @param int $category_id Category ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($film_id, $category_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($film_id, $category_id),
        ]);
    }

    /**
     * Creates a new FilmCategory model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new FilmCategory();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'film_id' => $model->film_id, 'category_id' => $model->category_id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing FilmCategory model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $film_id Film ID
     * @param int $category_id Category ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($film_id, $category_id)
    {
        $model = $this->findModel($film_id, $category_id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'film_id' => $model->film_id, 'category_id' => $model->category_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing FilmCategory model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $film_id Film ID
     * @param int $category_id Category ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($film_id, $category_id)
    {
        $this->findModel($film_id, $category_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the FilmCategory model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $film_id Film ID
     * @param int $category_id Category ID
     * @return FilmCategory the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($film_id, $category_id)
    {
        if (($model = FilmCategory::findOne(['film_id' => $film_id, 'category_id' => $category_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
