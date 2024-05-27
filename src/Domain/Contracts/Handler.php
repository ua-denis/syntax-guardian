<?php

namespace App\Domain\Contracts;

interface Handler
{
    public function setNext(Handler $handler): Handler;

    public function handle(string $expression): ?string;
}