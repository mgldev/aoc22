<?php

use AOC\D5\P1\Crane\CrateMover9000;
use AOC\D5\P1\RearrangementProcedure;

require_once __DIR__ . '/../../../../vendor/autoload.php';

$answer = RearrangementProcedure::fromInput(__DIR__ . '/../input.txt', new CrateMover9000())->execute();

echo "Part 1: $answer\n";
