<?php

namespace App\Presentation;

use App\Application\CheckerService;

class CLIController
{
    private CheckerService $service;

    public function __construct(CheckerService $service)
    {
        $this->service = $service;
    }

    public function handleInput(string $input): void
    {
        $result = $this->service->execute($input);
        echo "Result: $result".PHP_EOL;
    }
}