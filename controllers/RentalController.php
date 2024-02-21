<?php

namespace app\controllers;

use app\models\Rental;
use app\models\RentalSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * RentalController implements the CRUD actions for Rental model.
 */
class RentalController extends Controller
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
     * Lists all Rental models.
     *
     * @return string
     */
    public function actionIndex()
    {
    $searchModel = new RentalSearch();
    $dataProvider = $searchModel->search($this->request->queryParams);

    // Mengambil jumlah transaksi berdasarkan inventory_id, store_id, dan film_id
    $summary = Rental::summarizeTransactionCountByInventoryStoreFilm();

    return $this->render('index', [
        'searchModel' => $searchModel,
        'dataProvider' => $dataProvider,
        'summary' => $summary,
    ]);
    }


    /**
     * Displays a single Rental model.
     * @param int $rental_id Rental ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($rental_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($rental_id),
        ]);
    }

    /**
     * Creates a new Rental model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Rental();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'rental_id' => $model->rental_id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Rental model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $rental_id Rental ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($rental_id)
    {
        $model = $this->findModel($rental_id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'rental_id' => $model->rental_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Rental model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $rental_id Rental ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($rental_id)
    {
        $this->findModel($rental_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Rental model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $rental_id Rental ID
     * @return Rental the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($rental_id)
    {
        if (($model = Rental::findOne(['rental_id' => $rental_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
