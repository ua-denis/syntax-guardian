<?php

namespace App\Application;

use App\Domain\ParenthesesCheckerContext;

class CheckerService
{
    private ParenthesesCheckerContext $context;

    public function __construct(ParenthesesCheckerContext $context)
    {
        $this->context = $context;
    }

    public function execute(string $input): string
    {
        return $this->context->check($input);
    }
}