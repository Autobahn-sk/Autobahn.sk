<?php namespace AppUtil\Importer\Classes\Services;

use Backend\Facades\BackendAuth;

class ImportService
{
    /*
     * Get merge aliases from config and request
     */
    public static function getAliasesFromRequest()
    {
        $aliases = [];

        if (BackendAuth::getUser()->isSuperUser()) {
            $aliasesFromRequest = request()->post('aliases');
            $aliases = (array)json_decode(str_replace("\\", "\\\\", $aliasesFromRequest), true);
        }

        return $aliases;
    }

    /*
     * Get files from request
     */
    public static function getDataFromRequests()
    {
        $files = files();
        $data = [];

        foreach ($files as $file) {
            $data[$file->getClientOriginalName()] = file_get_contents($file->getRealPath());
        }

        return $data;
    }
}
