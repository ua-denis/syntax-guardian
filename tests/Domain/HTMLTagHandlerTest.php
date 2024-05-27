<?php

use App\Domain\Services\HTMLTagHandler;
use PHPUnit\Framework\TestCase;

class HTMLTagHandlerTest extends TestCase
{
    public function testCorrectTags(): void
    {
        $handler = new HTMLTagHandler();
        $result = $handler->handle('<div><p></p></div>');
        $this->assertEquals('True', $result); // Should return "True" for correct HTML tags
    }

    public function testIncorrectTags(): void
    {
        $handler = new HTMLTagHandler();
        $result = $handler->handle('<div><p></div></p>');
        $this->assertEquals('Wrong', $result); // Should return "Wrong" for incorrect HTML tags
    }
}