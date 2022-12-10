<?php

namespace AOC\D2\P1;

abstract class Hand
{
    abstract public function defeats(Hand $hand): bool;

    abstract public function getScore(): int;

    abstract public function getName(): string;

    public function matches(Hand $hand): bool
    {
        return $this->getName() === $hand->getName();
    }
}
