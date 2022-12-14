<?php

use AOC\Helper\InputReader;

require_once __DIR__ . '/../../../../vendor/autoload.php';

$instructions = InputReader::fileToLines(__DIR__ . '/../input.txt');

$head = ['x' => 0, 'y' => 0];
$tail = ['x' => 0, 'y' => 0];

$move = function (string $direction) use (&$head, &$tail) {
    $tailIsLost = fn (array $head, array $tail) =>
        ($head['y'] - $tail['y']) > 1 ||
        ($tail['y'] - $head['y']) > 1 ||
        ($head['x'] - $tail['x']) > 1 ||
        ($tail['x'] - $head['x']) > 1;


    $moveHead = match($direction) {
        'R' => function() use (&$head, &$tail, $tailIsLost) {
            $head['x']++;
            if ($tailIsLost($head, $tail)) {
                $tail['x'] = $head['x'] - 1;
                $tail['y'] = $head['y'];
            }
        },
        'D' => function () use (&$head, &$tail, $tailIsLost) {
            $head['y']++;
            if ($tailIsLost($head, $tail)) {
                $tail['y'] = $head['y'] - 1;
                $tail['x'] = $head['x'];
            }
        },
        'L' => function () use (&$head, &$tail, $tailIsLost) {
            $head['x']--;
            if ($tailIsLost($head, $tail)) {
                $tail['x'] = $head['x'] + 1;
                $tail['y'] = $head['y'];
            }
        },
        'U' => function () use (&$head, &$tail, $tailIsLost) {
            $head['y']--;
            if ($tailIsLost($head, $tail)) {
                $tail['y'] = $head['y'] + 1;
                $tail['x'] = $head['x'];
            }
        },
    };

    $moveHead();

    return implode(',', $tail);
};

$visited = [];

foreach ($instructions as $instruction) {
    [$direction, $places] = explode(' ', $instruction);
    for ($i = 0; $i < $places; $i++) {
        $visited[] = $move($direction);
    }
}

$answer = count(array_unique($visited));

echo "Part 1: $answer\n";
