<?php

namespace App\Infrastructure;

class Logger
{
    public function log(string $message): void
    {
        echo "[LOG]: $message".PHP_EOL;
    }
}