<?php
namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\rest\ActiveController;
use app\models\Payment;
use app\models\Summary;

class AggregationController extends ActiveController
{
    public $modelClass = 'app\models\Payment';

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actions()
    {
        $actions = parent::actions();
        unset($actions['index'], $actions['view'], $actions['create'], $actions['update'], $actions['delete']);
        return $actions;
    }

    public function actionCalculateSummary()
    {
        // Mendapatkan seluruh customer_id yang ada di tabel payment
        $customerIds = Payment::find()->select('customer_id')->distinct()->column();

        // Looping untuk setiap customer_id
        foreach ($customerIds as $customerId) {
            // Query untuk mendapatkan seluruh data payment berdasarkan customer_id
            $payments = Payment::find()->where(['customer_id' => $customerId])->all();

            // Inisialisasi variabel totalAmount
            $totalAmount = 0;

            // Looping untuk setiap payment
            foreach ($payments as $payment) {
                // Menambahkan nilai amount ke variabel totalAmount
                $totalAmount += $payment->amount;
            }

            // Membuat instance baru dari model Summary
            $summary = new Summary();
            $summary->customer_id = $customerId;
            $summary->total_amount = $totalAmount;

            // Menyimpan instance Summary ke dalam database
            $summary->save();
        }
    }
}
