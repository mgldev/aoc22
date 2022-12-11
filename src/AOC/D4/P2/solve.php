<?php

use AOC\D4\P1\SectionAssignmentPair;
use AOC\Helper\InputReader;

require_once __DIR__ . '/../../../../vendor/autoload.php';

$overlappingPairs = 0;

foreach (array_filter(InputReader::fileToLines(__DIR__ . '/../input.txt')) as $line) {
    $overlappingPairs += (int) SectionAssignmentPair::fromString($line)->hasOverlappingAssignment();
}

echo "Part 2: $overlappingPairs\n";
