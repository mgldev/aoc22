<?php

use AOC\D2\P1\RoundProvider\PartOneRoundProvider;
use AOC\D2\P1\StrategyGuide;
use AOC\D2\P2\RoundProvider\PartTwoRoundProvider;

require_once __DIR__ . '/../../../../vendor/autoload.php';

$roundProvider = new PartTwoRoundProvider(__DIR__ . '/../input.txt');
$answer = (new StrategyGuide($roundProvider->provide()))->getTotalScore();

echo 'Part 2: ' . $answer . "\n";