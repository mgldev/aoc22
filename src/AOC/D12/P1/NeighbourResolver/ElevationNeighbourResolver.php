<?php

namespace AOC\D12\P1\NeighbourResolver;

use AOC\D12\P1\Grid\ElevationGrid;
use AOC\D12\P1\NeighbourResolverInterface;
use AOC\D12\P1\Point;

/**
 * Class ElevationNeighbourResolver
 *
 * @package AOC\D12\P1\NeighbourResolver
 */
class ElevationNeighbourResolver implements NeighbourResolverInterface
{
    /**
     * ElevationNeighbourResolver constructor
     *
     * @param ElevationGrid $grid
     */
    public function __construct(private ElevationGrid $grid)
    {
    }

    /**
     * Resolve neighbours based on elevation compatibility
     *
     * @param Point $point
     *
     * @return Point[]
     */
    public function resolve(Point $point): array
    {
        $possible = [];

        foreach ([[0, 1], [0,-1], [1,0], [-1,0]] as $adjustment) {
            [$ax, $ay] = $adjustment;
            $checkPoint = new Point($point->x + $ax, $point->y + $ay);

            // off the grid
            if ($this->grid->getValue($checkPoint) === null) {
                continue;
            }

            $height = $this->grid->getValue($point)->getHeight();
            $checkHeight = $this->grid->getValue($checkPoint)->getHeight();

            if (($checkHeight - $height) < 2) {
                $possible[] = $checkPoint;
            }
        }

        return $possible;
    }
}

