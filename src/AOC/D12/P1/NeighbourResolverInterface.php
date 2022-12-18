<?php

namespace AOC\D12\P1;

interface NeighbourResolverInterface
{
    /**
     * Resolve the possible neighbours for a given point
     *
     * @param Point $point
     *
     * @return Point[]
     */
    public function resolve(Point $point): array;
}
