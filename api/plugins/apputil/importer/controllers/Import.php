<?php namespace AppUtil\Importer\Controllers;

use Backend\Classes\Controller;
use AppUtil\Importer\Classes\Importer;
use AppUtil\Importer\Classes\Services\ImportService;

/**
 * Importer Back-end Controller
 */
class Import extends Controller
{
    /*
     * Index action
     */
    public function index()
    {
        $this->addJs('/plugins/apputil/importer/controllers/import/assets/js/main.js');
        $this->addCss('/plugins/apputil/importer/controllers/import/assets/css/style.css');
    }

    /*
     * Index onImport ajax handler
     */
    public function index_onImport()
    {
        $aliases = ImportService::getAliasesFromRequest();
        $data = ImportService::getDataFromRequests();

        [$processedData, $flash] = Importer::import($data, $aliases);

        return [
            '#importer-flash' => sprintf("<div class='importer-flash-msg %s-flash'>%s</div>", $flash[0], $flash[1]),
            '#importer-response' => $this->makePartial('importer-response', [
                'data' => $processedData
            ]),
        ];
    }

}
