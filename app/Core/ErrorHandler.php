<?php

namespace App\Core;

use ErrorException;
use Throwable;

class ErrorHandler {

    public static function register(): void {
        set_exception_handler([self::class, 'handleException']);
        set_error_handler([self::class,'handleError']);
    }

    public static function handleException(Throwable $e): void {
        $isDebug = Env::get('APP_DEBUG', false);

        if ($isDebug) {
            (new Response())->setStatusCode(500)
                ->setContent("{$e->getMessage()}<pre>{$e->getTraceAsString()}</pre>")
                ->send();
            return;
        }

        (new Response())->setStatusCode(500)
            ->setContent("500 - Internal Server Error")
            ->send();
    }

    public static function handleError(int $severity, string $message, ?string $file, ?int $line): void {
        throw new ErrorException($message, 0, $severity, $file, $line);
    }
}