<?php

namespace app\controllers;

use app\models\KategoriSummary;
use app\models\KategoriSummarySearch;
use app\models\RentalSummary;
use app\models\Film;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use Yii;

/**
 * KategoriSummaryController implements the CRUD actions for KategoriSummary model.
 */
class KategoriSummaryController extends Controller
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

    public function actionSchedule(): void
    {
        $summaryData = RentalSummary::find()
            ->joinWith('film')
            ->groupBy('film.film_id')
            ->select([
                'film.film_id',
                'COUNT(rental_summary.film_id) AS jml_transaksi',
            ])
            ->where(['<=', 'rental_summary.tgl_kembali', strtotime("-1 day")])
            ->asArray()
            ->all();

        if (!empty($summaryData)) {
            $tableName = 'kategori_summary';
            $columns = ['film_id', 'jml_transaksi', 'category'];
            $categories = array_column(Yii::$app->params['kategori'], null, 'film_id');

            $rows = [];
            foreach ($summaryData as $data) {
                $row = [$data['film_id'], $data['jml_transaksi']];
                $row[] = isset($categories[$data['film_id']]) ? $categories[$data['film_id']] : '';
                $rows[] = $row;
            }

            Yii::$app->db->createCommand()->batchInsert($tableName, $columns, $rows)->execute();
        }
    }

    /**
     * Lists all KategoriSummary models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new KategoriSummarySearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    // ... (methods for view, create, update, delete)

    /**
     * Finds the KategoriSummary model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return KategoriSummary the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = KategoriSummary::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
