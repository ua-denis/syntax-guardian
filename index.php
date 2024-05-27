<?php

require __DIR__.'/Bootstrap.php';

$input = $argv[1] ?? '';
$controller->handleInput($input);