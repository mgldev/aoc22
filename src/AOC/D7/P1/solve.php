<?php

use AOC\D7\P1\FilesystemBuilder;

require_once __DIR__ . '/../../../../vendor/autoload.php';

$fs = FilesystemBuilder::buildFromFile(70000000, __DIR__ . '/../input.txt');
$answer = array_sum(array_filter($fs->getSubdirectorySizes(), fn (int $size) => $size <= 100000));

echo "Part 1: $answer\n";
