<?php

namespace AOC\D12\P1;

/**
 * Class Point
 *
 * @package AOC\D12\P1
 */
class Point
{
    /**
     * @param int $x
     * @param int $y
     */
    public function __construct(public int $x, public int $y)
    {
    }

    /**
     * @param Point $point
     *
     * @return bool
     */
    public function equals(Point $point): bool
    {
        return $this->x === $point->x && $this->y === $point->y;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->x . ',' . $this->y;
    }
}
