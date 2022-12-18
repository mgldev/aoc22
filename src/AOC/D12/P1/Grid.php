<?php

namespace AOC\D12\P1;

class Grid
{
    public function __construct(private array $grid)
    {
    }

    public function getValue(Point $point): mixed
    {
        return $this->grid[$point->x][$point->y] ?? null;
    }
}
