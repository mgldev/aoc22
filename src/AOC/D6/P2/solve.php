<?php

use AOC\D6\P1\MarkerFinder;

require_once __DIR__ . '/../../../../vendor/autoload.php';

echo 'Part 2: ' . MarkerFinder::fromInput(__DIR__ . '/../input.txt')->find(14) . "\n";
