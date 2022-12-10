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
    'A' => 'rock',
    'B' => 'paper',
    'C' => 'scissors'
};

$losesTo = function (string $key) use ($hands): string {
  foreach ($hands as $handKey => $hand) {
      if ($hand['beats'] === $key) {
          return $handKey;
      }
  }

  throw new RuntimeException('Found nothing which can beat it');
};

$totalScore = 0;

foreach (array_filter(InputReader::fileToLines(__DIR__ . '/../input.txt')) as $line) {
    [$theirs, $desiredOutcome] = explode(' ', $line);
    $theirs = $getHand($theirs);

    $mine = match ($desiredOutcome) {
        'X' => $hands[$theirs]['beats'],
        'Y' => $theirs,
        'Z' => $losesTo($theirs),
    };

    $config = $hands[$mine];
    $score = $config['points'];
    $score += ($theirs === $mine) ? 3 : ($theirs === $config['beats'] ? 6 : 0);
    $totalScore += $score;
}

echo "Answer: $totalScore\n";