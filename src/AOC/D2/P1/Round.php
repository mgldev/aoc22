<?php

namespace AOC\D2\P1;

class Round
{
    public function __construct(
        private Hand $theirs,
        private Hand $mine
    ) {}

    public function getScore(): int
    {
        $score = $this->mine->getScore();

        return $score + match (true) {
            $this->mine->matches($this->theirs) => 3,
            $this->mine->defeats($this->theirs) => 6,
            default => 0,
        };
    }
}
