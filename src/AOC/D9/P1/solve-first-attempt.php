<?php

use AOC\Helper\InputReader;

require_once __DIR__ . '/../../../../vendor/autoload.php';

$instructions = InputReader::fileToLines(__DIR__ . '/../input.txt');

$head = ['x' => 0, 'y' => 0];
$tail = ['x' => 0, 'y' => 0];

$move = function (string $direction) use (&$head, &$tail) {
    $tailIsLost = fn (array $head, array $tail) =>
        ($head['y'] - $tail['y']) > 1 || ($tail['y'] - $head['y']) > 1 ||
        ($head['x'] - $tail['x']) > 1 || ($tail['x'] - $head['x']) > 1;

    $config = match ($direction) {
        'R' => [
            'h' => fn (array &$head) => $head['x']++,
            'tx' => fn (array $head) => $head['x'] - 1,
            'ty' => fn (array $head) => $head['y']
        ],
        'D' => [
            'h' => fn (array &$head) => $head['y']++,
            'tx' => fn (array $head) => $head['x'],
            'ty' => fn (array $head) => $head['y'] - 1
        ],
        'L' => [
            'h' => fn (array &$head) => $head['x']--,
            'tx' => fn (array $head) => $head['x'] + 1,
            'ty' => fn (array $head) => $head['y']
        ],
        'U' => [
            'h' => fn (array &$head) => $head['y']--,
            'tx' => fn (array $head) => $head['x'],
            'ty' => fn (array $head) => $head['y'] + 1
        ],
    };

    $config['h']($head);

    if ($tailIsLost($head, $tail)) {
        $tail['x'] = $config['tx']($head);
        $tail['y'] = $config['ty']($head);
    }

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