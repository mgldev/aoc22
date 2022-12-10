<?php

namespace AOC\D2\P1\Hand;

use AOC\D2\P1\Hand;

class Scissors extends Hand
{
    public function defeats(Hand $hand): bool
    {
        return $hand instanceof Paper;
    }

    public function getScore(): int
    {
        return 3;
    }

    public function getName(): string
    {
        return 'scissors';
    }
}
