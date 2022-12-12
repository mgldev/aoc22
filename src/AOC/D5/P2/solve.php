<?php

use AOC\D5\P1\RearrangementProcedure;
use AOC\D5\P2\Crane\CrateMover9001;

require_once __DIR__ . '/../../../../vendor/autoload.php';

$answer = RearrangementProcedure::fromInput(__DIR__ . '/../input.txt', new CrateMover9001())->execute();

echo "Part 2: $answer\n";
