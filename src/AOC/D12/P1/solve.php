<?php

namespace AOC\D12\P1;

use AOC\D12\P1\Grid\ElevationGrid;
use AOC\D12\P1\NeighbourResolver\ElevationNeighbourResolver;

require_once __DIR__ . '/../../../../vendor/autoload.php';

$grid = ElevationGrid::fromInput(__DIR__ . '/../input.txt');
$neighbourResolver = new ElevationNeighbourResolver($grid);
$pathFinder = new PathFinder($neighbourResolver);
$start = $grid->getStartNode();
$destination = $grid->getDestinationNode();
$answer = $pathFinder->find($start, $destination)->getStepCount() - 1;

echo "Part 1: $answer\n";
