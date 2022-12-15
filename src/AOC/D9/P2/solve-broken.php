<?php

use AOC\Helper\InputReader;

require_once __DIR__ . '/../../../../vendor/autoload.php';

$instructions = InputReader::fileToLines(__DIR__ . '/../input.txt');

$snake = array_fill(0, 10, ['x' => 0, 'y' => 0]);

$visited = [];

foreach ($instructions as $instruction) {
    [$direction, $places] = explode(' ', $instruction);
    for ($i = 0; $i < $places; $i++) {
        $tailIsLost = fn (array $head, array $tail) =>
            abs($head['y'] - $tail['y']) > 1 || abs($head['x'] - $tail['x']) > 1;

        $config = match ($direction) {
            'U' => [
                'h' => fn (array &$head) => $head['y']++,
                'tx' => fn (array $head) => $head['x'],
                'ty' => fn (array $head) => $head['y'] + 1
            ],
            'R' => [
                'h' => fn (array &$head) => $head['x']++,
                'tx' => fn (array $head) => $head['x'] - 1,
                'ty' => fn (array $head) => $head['y']
            ],
            'D' => [
                'h' => fn (array &$head) => $head['y']--,
                'tx' => fn (array $head) => $head['x'],
                'ty' => fn (array $head) => $head['y'] - 1
            ],
            'L' => [
                'h' => fn (array &$head) => $head['x']--,
                'tx' => fn (array $head) => $head['x'] + 1,
                'ty' => fn (array $head) => $head['y']
            ],
        };

        $config['h']($snake[0]);

        for ($j = 0; $j < count($snake) - 1; $j++) {
            if ($tailIsLost($snake[$j], $snake[$j + 1])) {
                $snake[$j + 1]['x'] = $config['tx']($snake[$j]);
                $snake[$j + 1]['y'] = $config['ty']($snake[$j]);

                if ($j + 1 == count($snake) - 1) {
                    $visited[] = implode($snake[$j + 1]);
                }
            }
        }
    }
}

$answer = count(array_unique($visited));

echo "Part 2: $answer\n";