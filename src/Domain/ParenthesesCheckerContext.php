<?php

namespace App\Domain;

use App\Domain\Contracts\ParenthesesChecker;

class ParenthesesCheckerContext
{
    private ParenthesesChecker $checker;

    public function __construct(ParenthesesChecker $checker)
    {
        $this->checker = $checker;
    }

    public function setChecker(ParenthesesChecker $checker): void
    {
        $this->checker = $checker;
    }

    public function check(string $expression): string
    {
        return $this->checker->check($expression);
    }
}