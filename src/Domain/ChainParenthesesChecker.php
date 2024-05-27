<?php

namespace App\Domain;

use App\Domain\Contracts\Handler;
use App\Domain\Contracts\ParenthesesChecker;

class ChainParenthesesChecker implements ParenthesesChecker
{
    private Handler $handler;

    public function __construct(Handler $handler)
    {
        $this->handler = $handler;
    }

    public function check(string $expression): string
    {
        return $this->handler->handle($expression);
    }
}