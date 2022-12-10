<?php

namespace AOC\D1\P1;

class Elf
{
    private array $foodBag = [];

    public function addFood(Food $food): self
    {
        $this->foodBag[] = $food;

        return $this;
    }

    /**
     * @return int
     */
    public function getTotalCalories(): int
    {
        return array_sum(array_map(fn (Food $food) => $food->getCalories(), $this->foodBag));
    }
}
