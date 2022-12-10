<?php

require_once __DIR__ . '/../../../../vendor/autoload.php';

use AOC\D1\P1\ElfGroup;

$answer = ElfGroup::fromInput(__DIR__ . '/../input.txt')->getHighestCalorieCount();

echo 'Part 1: ' . $answer . "\n";