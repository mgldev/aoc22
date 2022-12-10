<?php

namespace AOC\D1\P1;

class Food
{
    private int $calories;

    /**
     * @param int $calories
     */
    public function __construct(int $calories)
    {
        $this->calories = $calories;
    }

    /**
     * @return int
     */
    public function getCalories(): int
    {
        return $this->calories;
    }
}
