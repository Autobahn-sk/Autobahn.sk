<?php namespace AppUtil\Util\Classes;

class BooleanValue
{
    public static function getBooleanValue($input): ?bool
    {
        if (is_bool($input)) {
            return $input;
        }

        if ($input === 0) {
            return false;
        }

        if ($input === 1) {
            return true;
        }

        if (is_string($input)) {
            switch (strtolower($input)) {
                case "true":
                case "on":
                case "1":
                    return true;
                    break;

                case "false":
                case "off":
                case "0":
                    return false;
                    break;
            }
        }
        return false;
    }
}
