<?php

namespace App\Domain\Services;

class BracketHandler extends AbstractHandler
{
    private array $brackets;
    private array $openingBrackets;

    public function __construct(array $brackets)
    {
        $this->brackets = $brackets;
        $this->openingBrackets = array_flip(array_values($brackets));
    }

    protected function process(string $expression): ?string
    {
        $stack = [];
        $length = strlen($expression);

        for ($i = 0; $i < $length; $i++) {
            $char = $expression[$i];

            if ($this->isOpeningBracket($char)) {
                $stack = $this->pushToStack($stack, $char);
            } elseif ($this->isClosingBracket($char)) {
                if ($this->isMismatch($stack, $char)) {
                    return 'Wrong';
                }

                $stack = $this->popFromStack($stack);
            }
        }

        return $this->isStackEmpty($stack) ? 'True' : 'Wrong';
    }

    private function isOpeningBracket(string $char): bool
    {
        return isset($this->openingBrackets[$char]);
    }

    private function isClosingBracket(string $char): bool
    {
        return isset($this->brackets[$char]);
    }

    private function pushToStack(array $stack, string $char): array
    {
        $stack[] = $char;
        return $stack;
    }

    private function popFromStack(array $stack): array
    {
        array_pop($stack);
        return $stack;
    }

    private function isMismatch(array $stack, string $char): bool
    {
        return empty($stack) || $stack[count($stack) - 1] !== $this->brackets[$char];
    }

    private function isStackEmpty(array $stack): bool
    {
        return empty($stack);
    }
}