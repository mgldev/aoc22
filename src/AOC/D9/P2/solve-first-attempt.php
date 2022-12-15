<?php

use AOC\Helper\InputReader;

require_once __DIR__ . '/../../../../vendor/autoload.php';

$instructions = InputReader::fileToLines(__DIR__ . '/../input.txt');

$snake = array_fill(0, 10, ['x' => 0, 'y' => 0]);

$visited = [implode(',', $snake[0])];

foreach ($instructions as $instruction) {
    [$direction, $places] = explode(' ', $instruction);
    for ($i = 0; $i < $places; $i++) {

        match ($direction) {
            'U' => $snake[0]['y']++,
            'R' => $snake[0]['x']++,
            'D' => $snake[0]['y']--,
            'L' => $snake[0]['x']--,
        };

        for ($j = 0; $j < count($snake) - 1; $j++) {
            $dx = $snake[$j]['x'] - $snake[$j + 1]['x'];
            $dy = $snake[$j]['y'] - $snake[$j + 1]['y'];
            $tailIsLost = abs($dx) > 1 || abs($dy) > 1;

            if ($tailIsLost) {
                $snake[$j + 1]['x'] += gmp_sign($dx);
                $snake[$j + 1]['y'] += gmp_sign($dy);

                if ($j + 1 == count($snake) - 1) {
                    $visited[] = implode(',', $snake[$j + 1]);
                }
            }
        }
    }
}

$answer = count(array_unique($visited));

echo "Part 2: $answer\n";