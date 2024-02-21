<?php

namespace app\controllers;

use app\models\Payment;
use app\models\PaymentSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PaymentController implements the CRUD actions for Payment model.
 */
class PaymentController extends Controller
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
     * Lists all Payment models.
     *
     * @return string
     */
    public function actionIndex()
    {
    $searchModel = new PaymentSearch();
    $dataProvider = $searchModel->search($this->request->queryParams);

    // Mendapatkan ringkasan data jumlah amount berdasarkan customer_id
    $summary = Payment::summarizeAmountByCustomerId();

    // Mendapatkan 10 customer_id teratas berdasarkan jumlah amount
    $topCustomers = Payment::find()
        ->select(['customer_id', 'SUM(amount) as total_amount'])
        ->groupBy('customer_id')
        ->orderBy(['total_amount' => SORT_DESC])
        ->limit(10)
        ->asArray()
        ->all();

    // Siapkan data untuk chart
    $chartData = [];
    foreach ($topCustomers as $customer) {
        $chartData[] = [
            'name' => 'Customer ID ' . $customer['customer_id'],
            'y' => (float) $customer['total_amount'], // Pastikan jumlah amount sudah diubah ke tipe float jika diperlukan
        ];
    }

    return $this->render('index', [
        'searchModel' => $searchModel,
        'dataProvider' => $dataProvider,
        'summary' => $summary,
        'chartData' => $chartData,
    ]);
    }


    /**
     * Displays a single Payment model.
     * @param int $payment_id Payment ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($payment_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($payment_id),
        ]);
    }

    /**
     * Creates a new Payment model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Payment();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'payment_id' => $model->payment_id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Payment model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $payment_id Payment ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($payment_id)
    {
        $model = $this->findModel($payment_id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'payment_id' => $model->payment_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Payment model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $payment_id Payment ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($payment_id)
    {
        $this->findModel($payment_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Payment model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $payment_id Payment ID
     * @return Payment the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($payment_id)
    {
        if (($model = Payment::findOne(['payment_id' => $payment_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    
}