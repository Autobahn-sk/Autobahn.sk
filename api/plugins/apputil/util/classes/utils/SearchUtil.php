<?php namespace AppUtil\Util\Classes;

class SearchUtil
{
    public static function prepareSearchQuery($searchQuery): string
    {
        return addcslashes($searchQuery, '%_\\');
    }
}
