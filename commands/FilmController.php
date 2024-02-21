<?php

namespace app\commands;

use yii\console\Controller;
use Yii;
use yii\console\ExitCode;


class FilmController extends Controller
{
    public function actionIndex()
{
    $data = Yii::$app->db->createCommand("
        SELECT fc.category_id, c.name, COUNT(*) AS jumlah_sewa
        FROM film_category fc
        INNER JOIN category c ON fc.category_id = c.category_id
        GROUP BY fc.category_id
        ORDER BY jumlah_sewa DESC
        LIMIT 10
    ")->queryAll();

    // Cetak data ke console
    print_r($data);

    return $data; // Mengembalikan data sebagai response dari action
}


}