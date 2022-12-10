<?php

use AOC\D2\P1\StrategyGuide;

require_once __DIR__ . '/../../../../vendor/autoload.php';

$answer = StrategyGuide::fromFile(__DIR__ . '/../input.txt')->getTotalScore();

echo 'Part 1: ' . $answer . "\n";