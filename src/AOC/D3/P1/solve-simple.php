<?php

require_once __DIR__ . '/../../../../vendor/autoload.php';

use AOC\Helper\InputReader;

$sum = 0;

foreach (array_filter(InputReader::fileToLines(__DIR__ . '/../input.txt')) as $line) {
    $compartments = array_map(
        fn (string $compartment) => str_split($compartment),
        str_split($line, strlen($line) / 2)
    );
    $common = array_unique(array_intersect($compartments[0], $compartments[1]));
    $sum += array_sum(array_map(fn (string $char) => ord($char) - (ctype_upper($char) ? 38 : 96), $common));
}

echo "Part 1: $sum\n";
