<?php

namespace App\Domain\Contracts;

interface ParenthesesChecker
{
    public function check(string $expression): string;
}