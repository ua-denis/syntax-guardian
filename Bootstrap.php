<?php

require __DIR__.'/vendor/autoload.php';

use App\Application\CheckerService;
use App\Domain\ChainParenthesesChecker;
use App\Domain\ParenthesesCheckerContext;
use App\Domain\Services\BracketHandler;
use App\Domain\Services\HTMLTagHandler;
use App\Presentation\CLIController;

// Dynamic brackets mapping
$brackets = [
    ')' => '(',
    ']' => '[',
    '}' => '{',
    '>' => '<'
];

// Set up the chain of responsibility
$bracketHandler = new BracketHandler($brackets);
$htmlTagHandler = new HTMLTagHandler();

$bracketHandler->setNext($htmlTagHandler);

$checker = new ChainParenthesesChecker($bracketHandler);
$context = new ParenthesesCheckerContext($checker);
$service = new CheckerService($context);

$controller = new CLIController($service);