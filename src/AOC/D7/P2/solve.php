<?php

use AOC\D7\P1\FilesystemBuilder;
use AOC\D7\P2\UpdateCleaner;

require_once __DIR__ . '/../../../../vendor/autoload.php';

$fs = FilesystemBuilder::buildFromFile(70000000, __DIR__ . '/../input.txt');
$answer = (new UpdateCleaner($fs))->getDirectoryToRemove(30000000)->getTotalSize();

echo "Part 2: $answer\n";
