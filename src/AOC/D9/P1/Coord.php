<?php

namespace AOC\D9\P1;

class Coord
{
    public function __construct(public int $x, public int $y)
    {
    }

    public function __toString(): string
    {
        return $this->x . ',' . $this->y;
    }
}
