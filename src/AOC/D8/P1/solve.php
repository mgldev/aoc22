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
$visibleTrees = 0;

for ($x = 0; $x < $xCount; $x++) {
    for ($y = 0; $y < $yCount; $y++) {
        $isEdge = ($x === 0 || $x === ($xCount - 1)) || ($y === 0 || $y === ($yCount - 1));

        if ($isEdge) {
            $visibleTrees++;
            continue;
        }

        $scans = [
            'north' => function () use ($grid, $x, $y): bool {
                for ($i = $y - 1; $i >= 0; $i--) {
                    if ($grid[$x][$i] >= $grid[$x][$y]) {
                        return false;
                    }
                }
                return true;
            },
            'south' => function () use ($grid, $x, $y, $yCount): bool {
                for ($i = $y + 1; $i < $yCount; $i++) {
                    if ($grid[$x][$i] >= $grid[$x][$y]) {
                        return false;
                    }
                }
                return true;
            },
            'west' => function () use ($grid, $x, $y): bool {
                for ($i = $x - 1; $i >= 0; $i--) {
                    if ($grid[$i][$y] >= $grid[$x][$y]) {
                        return false;
                    }
                }
                return true;
            },
            'east' => function () use ($grid, $x, $y, $xCount): bool {
                for ($i = $x + 1; $i < $xCount; $i++) {
                    if ($grid[$i][$y] >= $grid[$x][$y]) {
                        return false;
                    }
                }
                return true;
            }
        ];

        foreach ($scans as $visible) {
            if ($visible()) {
                $visibleTrees++;
                break;
            }
        }
    }
}

echo "Answer: $visibleTrees\n";