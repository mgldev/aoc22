<?php

namespace AOC\D2\P1\Hand;

use AOC\D2\P1\Hand;

class Paper extends Hand
{
    public function defeats(Hand $hand): bool
    {
        return $hand instanceof Rock;
    }

    public function getScore(): int
    {
        return 2;
    }

    public function getName(): string
    {
        return 'paper';
    }
}
