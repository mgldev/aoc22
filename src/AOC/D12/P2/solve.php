<?php

namespace AOC\D12\P2;

use AOC\D12\P1\Grid\ElevationGrid;
use AOC\D12\P1\NeighbourResolver\ElevationNeighbourResolver;
use AOC\D12\P1\Path;
use AOC\D12\P1\PathFinder;
use AOC\D12\P1\Point;

require_once __DIR__ . '/../../../../vendor/autoload.php';

$grid = ElevationGrid::fromInput(__DIR__ . '/../input.txt');
$neighbourResolver = new ElevationNeighbourResolver($grid);
$pathFinder = new PathFinder($neighbourResolver);
$destination = $grid->getDestinationNode();

$answer = min(
    array_filter(
        array_map(
            function (Point $start) use ($pathFinder, $destination) {
                $path = $pathFinder->find($start, $destination);
                
                if ($path instanceof Path) {
                    return $path->getStepCount() - 1;
                }
                return null;
            },
            $grid->findByHeight(1)
        ),
        fn ($value) => $value !== null
    )
);

echo "Part 2: $answer\n";
