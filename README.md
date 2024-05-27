Dynamic brackets mapping
```
$brackets = [
    ')' => '(',
    ']' => '[',
    '}' => '{',
    '>' => '<'
];
```

Set up the chain of responsibility
```
$bracketHandler = new BracketHandler($brackets);
$htmlTagHandler = new HTMLTagHandler();

$bracketHandler->setNext($htmlTagHandler);

$checker = new ChainParenthesesChecker($bracketHandler);
$context = new ParenthesesCheckerContext($checker);
$service = new CheckerService($context);

$controller = new CLIController($service);
```

Testing with brackets
```
$controller->handleInput('[({})]'); // Output: True
$controller->handleInput('[([)]');  // Output: Wrong
$controller->handleInput('[({<>})]');  // Output: True

// or

echo $context->check('[({})]') . PHP_EOL; // Output: True
echo $context->check('[([)]') . PHP_EOL;  // Output: Wrong
echo $context->check('[({<>})]') . PHP_EOL;  // Output: True

// or from console comand

php index.php "[({})]"  // Output: True
php index.php "[([)]"  // Output: Wrong
php index.php "[({<>})]"  // Output: True
```

Testing with HTML tags
```
$controller->handleInput('<div><p></p></div>'); // Output: True
$controller->handleInput('<div><p></div></p>');  // Output: Wrong

// or

echo $context->check('<div><p></p></div>') . PHP_EOL;  // Output: True
echo $context->check('<div><p></div></p>') . PHP_EOL;  // Output: Wrong

// or from console comand

php index.php "<div><p></p></div>"  // Output: True
php index.php "<div><p></div></p>"  // Output: Wrong
```
