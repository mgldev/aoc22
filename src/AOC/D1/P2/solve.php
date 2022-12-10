<?php

require_once __DIR__ . '/../../../../vendor/autoload.php';

use AOC\D1\P2\ElfGroup;

$answer = ElfGroup::fromInput(__DIR__ . '/../input.txt')->getCalorieCountTopElves(3);

echo 'Part 2: ' . $answer . "\n";