<?php

use AOC\Helper\InputReader;

require_once __DIR__ . '/../../../../vendor/autoload.php';

$lines = [];
$stacks = [];

foreach (InputReader::fileToLines(__DIR__ . '/../input.txt') as $line) {
    if (is_numeric(str_replace(' ', '', $line))) {
        $stackCount = (int) max(explode('   ', $line));
        $stack = array_fill(0, $stackCount, []);
        $lines = array_reverse($lines);

        foreach ($lines as $row) {
            $columns = str_split($row, 4);
            foreach ($columns as $index => $value) {
                if (trim($value) !== '') {
                    $stacks[$index][] = trim(str_replace([' ', '[', ']'], '', $value));
                }
            }
        }
    }

    if (count($stacks) === 0) {
        $lines[] = $line;
    } else {
        $instruction = [];
        if (preg_match('/move (?<qty>\d+) from (?<from>\d+) to (?<to>\d+)/', $line, $instruction)) {
            $stack = &$stacks[$instruction['from'] - 1];
            for ($i = 0; $i < $instruction['qty']; $i++) {
                $stacks[$instruction['to'] - 1][] = array_pop($stack);
            }
        }
    }
}

$answer = implode(array_map(fn (array $stack) => array_pop($stack), $stacks));

echo "Part 1: $answer\n";
