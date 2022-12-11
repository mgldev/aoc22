<?php

require_once __DIR__ . '/../../../../vendor/autoload.php';

use AOC\Helper\InputReader;

$sum = 0;
$group = [];

foreach (array_filter(InputReader::fileToLines(__DIR__ . '/../input.txt')) as $line) {
    $group[] = str_split($line);

    if (count($group) === 3) {
        $common = array_unique(array_intersect(...$group));
        $sum += array_sum(array_map(fn (string $char) => ord($char) - (ctype_upper($char) ? 38 : 96), $common));
        $group = [];
    }
}

echo "Part 2: $sum\n";
