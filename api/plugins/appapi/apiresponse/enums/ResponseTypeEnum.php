<?php namespace AppApi\ApiResponse\Enums;

enum ResponseTypeEnum: string
{
    case ERROR = 'error';
    case SUCCESS = 'success';
    case WARNING = 'warning';
    case INFO = 'info';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    public static function successTypes(): array
    {
        return [self::SUCCESS, self::INFO];
    }

    public static function errorTypes(): array
    {
        return [self::ERROR, self::WARNING];
    }
}
