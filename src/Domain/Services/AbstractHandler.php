<?php

namespace App\Domain\Services;

use App\Domain\Contracts\Handler;

abstract class AbstractHandler implements Handler
{
    private ?Handler $nextHandler = null;

    public function setNext(Handler $handler): Handler
    {
        $this->nextHandler = $handler;
        return $handler;
    }

    public function handle(string $expression): ?string
    {
        $result = $this->process($expression);
        if ($result !== 'True') {
            return $result;
        }

        if ($this->nextHandler) {
            return $this->nextHandler->handle($expression);
        }

        return 'True';
    }

    abstract protected function process(string $expression): ?string;
}