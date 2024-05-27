<?php

namespace App\Domain\Services;

class HTMLTagHandler extends AbstractHandler
{
    protected function process(string $expression): ?string
    {
        $stack = [];
        $length = strlen($expression);

        for ($i = 0; $i < $length; $i++) {
            if ($expression[$i] === '<') {
                $tag = $this->extractTag($expression, $i);
                if ($tag === null) {
                    return 'Wrong';
                }

                if ($this->isBracketTag($tag)) {
                    continue;
                }

                if ($this->isClosingTag($tag)) {
                    if ($this->isMismatch($stack, $tag)) {
                        return 'Wrong';
                    }

                    $stack = $this->popFromStack($stack);
                } else {
                    $stack = $this->pushToStack($stack, $tag);
                }
                $i += strlen($tag) - 1;
            }
        }

        return $this->isStackEmpty($stack) ? 'True' : 'Wrong';
    }

    private function extractTag(string $expression, int $index): ?string
    {
        $tagEnd = strpos($expression, '>', $index);
        if ($tagEnd === false) {
            return null;
        }
        return substr($expression, $index, $tagEnd - $index + 1);
    }

    private function isClosingTag(string $tag): bool
    {
        return $tag[1] === '/';
    }

    private function isBracketTag(string $tag): bool
    {
        return $tag === '<>' || $tag === '</>';
    }

    private function pushToStack(array $stack, string $tag): array
    {
        $stack[] = $tag;
        return $stack;
    }

    private function popFromStack(array $stack): array
    {
        array_pop($stack);
        return $stack;
    }

    private function isMismatch(array $stack, string $tag): bool
    {
        $expectedOpeningTag = str_replace('/', '', $tag);
        return empty($stack) || $stack[count($stack) - 1] !== $expectedOpeningTag;
    }

    private function isStackEmpty(array $stack): bool
    {
        return empty($stack);
    }
}