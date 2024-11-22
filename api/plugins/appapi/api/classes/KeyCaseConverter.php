<?php namespace AppApi\Api\Classes;

use Illuminate\Support\Str;
use InvalidArgumentException;

class KeyCaseConverter
{
   public const CASE_SNAKE = 'snake';
   public const CASE_CAMEL = 'camel';

   /**
    * Convert an array to a given case.
    *
    * @param string $case
    * @param $data
    * @return array
    */
   public static function convert(string $case, $data)
   {
      if (!in_array($case, [self::CASE_CAMEL, self::CASE_SNAKE])) {
         throw new InvalidArgumentException('Case must be either snake or camel');
      }

      if (!is_array($data)) {
         return $data;
      }

      $array = [];

      foreach ($data as $key => $value) {
         $array[Str::{$case}($key)] = is_array($value)
            ? self::convert($case, $value)
            : $value;
      }

      return $array;
   }
}
