<?php

use AOC\Helper\InputReader;

require_once __DIR__ . '/../../../../vendor/autoload.php';

$grid = [];

foreach (InputReader::fileToLines(__DIR__ . '/../input.txt') as $y => $line) {
    foreach (str_split($line) as $x => $height) {
        if (!isset($grid[$x])) {
            $grid[$x] = [];
        }
        $grid[$x][$y] = $height;
    }
}

$xCount = count($grid);
$yCount = count($grid[0]);
$highestScenicScore = 0;

for ($x = 0; $x < $xCount; $x++) {
    for ($y = 0; $y < $yCount; $y++) {
        $viewingDistanceFunctions = [
            'north' => function () use ($grid, $x, $y): int {
                $score = 0;
                for ($i = $y - 1; $i >= 0; $i--) {
                    $score++;
                    if ($grid[$x][$i] >= $grid[$x][$y]) {
                        break;
                    }
                }
                return $score;
            },
            'south' => function () use ($grid, $x, $y, $yCount): int {
                $score = 0;
                for ($i = $y + 1; $i < $yCount; $i++) {
                    $score++;
                    if ($grid[$x][$i] >= $grid[$x][$y]) {
                        break;
                    }
                }
                return $score;
            },
            'west' => function () use ($grid, $x, $y): int {
                $score = 0;
                for ($i = $x - 1; $i >= 0; $i--) {
                    $score++;
                    if ($grid[$i][$y] >= $grid[$x][$y]) {
                        break;
                    }
                }
                return $score;
            },
            'east' => function () use ($grid, $x, $y, $xCount): int {
                $score = 0;
                for ($i = $x + 1; $i < $xCount; $i++) {
                    $score++;
                    if ($grid[$i][$y] >= $grid[$x][$y]) {
                        break;
                    }
                }
                return $score;
            }
        ];

        $viewingDistances = array_map(fn (callable $function) => $function(), $viewingDistanceFunctions);
        $scenicScore = array_product($viewingDistances);

        if ($scenicScore > $highestScenicScore) {
            $highestScenicScore = $scenicScore;
        }
    }
}

echo "Answer: $highestScenicScore\n";