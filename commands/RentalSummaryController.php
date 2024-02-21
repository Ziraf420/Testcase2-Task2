<?php

namespace app\commands;

use Yii;
use yii\console\Controller;
use app\models\Rental;
use app\models\RentalSummary;

class RentalSummaryController extends Controller
{
    /**
     * Summarizes the rental transactions and stores it in the 'rental_summary' table.
     * @return int Exit code
     */
    public function actionIndex()
    {
        $summary = self::summarizeTransactionCountByInventoryStoreFilm();

        // Insert data into the 'rental_summary' table
        foreach ($summary as $inventoryId => $storeData) {
            foreach ($storeData as $storeId => $filmData) {
                foreach ($filmData as $filmId => $transactionCount) {
                    $rentalSummary = new RentalSummary();
                    $rentalSummary->inventory_id = $inventoryId;
                    $rentalSummary->store_id = $storeId;
                    $rentalSummary->film_id = $filmId;
                    $rentalSummary->transaction_count = $transactionCount;
                    $rentalSummary->save();
                }
            }
        }

        return Controller::EXIT_CODE_NORMAL;
    }

    /**
     * Summarizes the rental transactions by inventory, store, and film.
     * @return array Summary data
     */
    public static function summarizeTransactionCountByInventoryStoreFilm()
    {
        $summary = [];

        $rentals = Rental::find()
            ->select(['rental.inventory_id', 'inventory.store_id', 'inventory.film_id', 'COUNT(*) AS transaction_count'])
            ->join('JOIN', 'inventory', 'rental.inventory_id = inventory.inventory_id')
            ->groupBy(['rental.inventory_id', 'inventory.store_id', 'inventory.film_id'])
            ->asArray()
            ->all();

        foreach ($rentals as $rental) {
            $inventoryId = $rental['inventory_id'];
            $storeId = $rental['store_id'];
            $filmId = $rental['film_id'];
            $transactionCount = $rental['transaction_count'];

            if (!isset($summary[$inventoryId][$storeId][$filmId])) {
                $summary[$inventoryId][$storeId][$filmId] = 0;
            }

            $summary[$inventoryId][$storeId][$filmId] += $transactionCount;
        }
        print_r ($rentals);
        return $summary;
        
    }
}
