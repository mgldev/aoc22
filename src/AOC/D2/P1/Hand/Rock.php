<?php

namespace AOC\D2\P1\Hand;

use AOC\D2\P1\Hand;

class Rock extends Hand
{
    public function defeats(Hand $hand): bool
    {
        return $hand instanceof Scissors;
    }

    public function getScore(): int
    {
        return 1;
    }

    public function getName(): string
    {
        return 'rock';
    }
}
