<?php 

namespace App\Core;

class Logger {

    protected static string $file = __DIR__ . '/../../storage/logs/app.log';

    public static function log(string $level, string $message): void {
        $date = date('Y-m-d H:i:s');

        $line = "[{$date}] {$level}: {$message}" . PHP_EOL;

        file_put_contents(self::$file, $line, FILE_APPEND);
    }

    public static function info(string $message): void {
        self::log('INFO', $message);
    }

    public static function error(string $message): void {
        self::log('ERROR', $message);
    }

    public static function warning(string $message): void {
        self::log('WARNING', $message);
    }

}