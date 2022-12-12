<?php

require_once __DIR__ . '/../../../../vendor/autoload.php';

$input = str_split(file_get_contents(__DIR__ . '/../input.txt'));
$count = count($input);

for ($i = 0; $i < $count; $i++) {
    if (count(array_unique(array_slice($input, $i, 4))) === 4) {
        die('Part 1: ' . ($i + 4) . "\n");
    }
}
