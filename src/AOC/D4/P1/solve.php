<?php

use AOC\D4\P1\SectionAssignmentPair;
use AOC\Helper\InputReader;

require_once __DIR__ . '/../../../../vendor/autoload.php';

$fullyConsumingPairs = 0;

foreach (array_filter(InputReader::fileToLines(__DIR__ . '/../input.txt')) as $line) {
    $fullyConsumingPairs += (int) SectionAssignmentPair::fromString($line)->hasFullyOverlappingAssignment();
}

echo "Part 1: $fullyConsumingPairs\n";
