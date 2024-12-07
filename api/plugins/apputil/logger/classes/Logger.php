<?php namespace AppUtil\Logger\Classes;

use Exception;
use Ramsey\Uuid\Uuid;
use AppUtil\Logger\Models\Log;

class Logger
{
    public static $logs = [];

    protected static function log(string $level, string $message, Exception $exception = null)
    {
        if (!isset($GLOBALS['request_id'])) {
            $GLOBALS['request_id'] = Uuid::uuid4();
        }
        $request_id = $GLOBALS['request_id'];

        $log = new Log;

        $log->request_id = $request_id;
        $log->level = $level;
        $log->log_text = $message;
        $log->exception = $exception ? $exception->getMessage() . PHP_EOL . $exception->getTraceAsString() : null;
        $log->created_at = now()->format('Y-m-d H:i:s.u');

        $log->save();
        self::$logs[] = $log;

        return $log;
    }

    public static function debug(string $message, $exception = null)
    {
        return self::log('DEBUG', $message, $exception);
    }

    public static function info(string $message, $exception = null)
    {
        return self::log('INFO', $message, $exception);
    }

    public static function warn(string $message, $exception = null)
    {
        return self::log('WARN', $message, $exception);
    }

    public static function error(string $message, $exception = null)
    {
        return self::log('ERROR', $message, $exception);
    }
}
