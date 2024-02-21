<?php
/**
 * @link https://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license https://www.yiiframework.com/license/
 */

namespace app\commands;

use Yii;
use yii\console\Controller;
use yii\db\Query;

/**
 * This command calculates the summary of payments and stores it in the 'summary' table.
 *
 * This command is provided as an example for you to learn how to create console commands.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class SummaryController extends Controller
{
    /**
     * This command calculates the summary of payments and stores it in the 'summary' table.
     * @return int Exit code
     */
    public function actionIndex()
    {
        $db = Yii::$app->db;
        $query = new Query;
        $data = $query->select('customer_id, SUM(amount) as total_amount')
            ->from('payment')
            ->groupBy('customer_id')
            ->all();

        // Memasukkan data ke dalam tabel 'summary'
        foreach ($data as $row) {
            $db->createCommand()->insert('summary', [
                'customer_id' => $row['customer_id'],
                'total_amount' => $row['total_amount'],
            ])->execute();
        }

        return Controller::EXIT_CODE_NORMAL;
    }
}
