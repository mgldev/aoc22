<?php

use AOC\Helper\InputReader;

require_once __DIR__ . '/../../../../vendor/autoload.php';

$cycle = 0;
$x = 1;
$history = [];

foreach (InputReader::fileToLines(__DIR__ . '/../input.txt') as $instruction) {
    $parts = explode(' ', $instruction);
    $command = $parts[0];
    $value = isset($parts[1]) ? (int) $parts[1] : null;

    switch ($command) {
        case 'noop':
            $cycle += 1;
            $history[$cycle] = $x;
            break;

        case 'addx':
            $history[$cycle + 1] = $history[$cycle + 2] = $x;
            $x += $value;
            $cycle += 2;
            break;
    }
}

$sum = 20 * $history[20];

for ($i = 60; $i <= 220; $i += 40) {
    $sum += $i * $history[$i];
}

echo "Part 1: $sum\n";
