<?php namespace AppUtil\Importer\Classes;

use Exception;
use League\Csv\Reader;
use Illuminate\Support\Facades\Event;
use AppUtil\Importer\Classes\Seeder\ModelSeeder;
use AppUtil\Importer\Classes\Parsers\UtilParser;
use AppUtil\Importer\Classes\Parsers\HeaderParser;
use AppUtil\Importer\Classes\Parsers\RecordsParser;

class Importer
{
    /*
     * Import
     */
    public static function import($data, $additionalAliases = [], $additionalIgnore = [])
    {
        $flash = ['success', 'Data successfully imported'];
        $processedRecords = [];

        $ignore = UtilParser::mergeIgnoreColumns($additionalIgnore);
        $aliases = UtilParser::mergeAliases($additionalAliases);
        $data = UtilParser::dataFromCsvStrings($data);


        Event::fire('apputil.importer.beforeImport', [&$data, &$aliases, &$ignore]);


        foreach ($data as $sheetKey => $singleData) {
            try {
                $data = self::prepareRecords($singleData, $aliases, $ignore);

                Event::fire('apputil.importer.beforeSeedData', [&$data]);

                foreach ($data as $modelAlias => $records) {
                    $model = $aliases[$modelAlias];
                    $processedRecords[$sheetKey][$modelAlias] = collect();

                    foreach ($records as $record) {
                        $processedRecords[$sheetKey][$modelAlias]->push($record);
                        ModelSeeder::seed($model, $record);
                    }
                }

            } catch (Exception $exception) {
                $flash = ['error', $exception->getMessage()];
            }
        }

        Event::fire('apputil.importer.import', [&$processedRecords]);

        return [$processedRecords, $flash];
    }

    /*
     * Prepare single file data
     */
    protected static function prepareRecords($data, $aliases, $ignore)
    {
        $reader = Reader::createFromString($data);
        $header = HeaderParser::prepareHeader($reader, $aliases);

        return RecordsParser::prepareRecords($reader, $header, $ignore);
    }
}
