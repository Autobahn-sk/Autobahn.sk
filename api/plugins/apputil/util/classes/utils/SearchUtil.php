<?php namespace AppUtil\Util\Classes\Utils;

class SearchUtil
{
    public static function prepareSearchQuery($searchQuery): string
    {
        return addcslashes($searchQuery, '%_\\');
    }
}
