<?php

use AOC\Helper\InputReader;

require_once __DIR__ . '/../../../../vendor/autoload.php';

$hands = [
    'rock' => [
        'beats' => 'scissors',
        'points' => 1
    ],
    'paper' => [
        'beats' => 'rock',
        'points' => 2,
    ],
    'scissors' => [
        'beats' => 'paper',
        'points' => 3,
    ]
];

$getHand = fn ($id) => match ($id) {
    'A', 'X' => 'rock',
    'B', 'Y' => 'paper',
    'C', 'Z' => 'scissors'
};

$totalScore = 0;

foreach (array_filter(InputReader::fileToLines(__DIR__ . '/../input.txt')) as $line) {
    [$theirs, $mine] = array_map(fn (string $key) => $getHand($key), explode(' ', $line));
    $config = $hands[$mine];
    $score = $config['points'];
    $score += ($theirs === $mine) ? 3 : ($theirs === $config['beats'] ? 6 : 0);
    $totalScore += $score;
}

echo "Answer: $totalScore\n";