<?php

use App\Domain\Services\BracketHandler;
use PHPUnit\Framework\TestCase;

class BracketHandlerTest extends TestCase
{
    public function testCorrectBrackets(): void
    {
        $brackets = [
            ')' => '(',
            ']' => '[',
            '}' => '{',
            '>' => '<'
        ];

        $handler = new BracketHandler($brackets);
        $result = $handler->handle('[({<>})]');
        $this->assertEquals('True', $result); // Should return "True" for correct brackets
    }

    public function testIncorrectBrackets(): void
    {
        $brackets = [
            ')' => '(',
            ']' => '[',
            '}' => '{',
            '>' => '<'
        ];

        $handler = new BracketHandler($brackets);
        $result = $handler->handle('[([)]');
        $this->assertEquals('Wrong', $result); // Should return "Wrong" for incorrect brackets
    }
}