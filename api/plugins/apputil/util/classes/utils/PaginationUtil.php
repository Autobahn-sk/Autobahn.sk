<?php namespace AppUtil\Util\Classes\Utils;

class PaginationUtil
{
    public static function getPagination($maxPageItems = 500)
    {
        return min((int)input('limit', 50), $maxPageItems);
    }
}

