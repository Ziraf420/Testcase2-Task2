<?php

namespace app\commands;

use Yii;
use yii\console\Controller;
use app\models\RentalSummary;
use app\models\Film;
use app\models\KategoriSummary;

class KategoriSummaryController extends Controller
{
    private const STATUS_SEWA_SELESAI = 'SEWAACTIVE';

    public function actionSchedule(): void
    {
        $summaryData = RentalSummary::find()
        ->joinWith('film')
        ->groupBy('film.film_id')
        ->select([
            'film.film_id',
            'COUNT(rental_summary.film_id) AS jml_transaksi',
        ])
        ->where(['<=','rental_summary.tgl_kembali', strtotime("-1 day")])
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
    public function getFilm()
    {
        return $this->hasOne(Film::class, ['film_id' => 'film_id']);
    }
    

    
  
}
