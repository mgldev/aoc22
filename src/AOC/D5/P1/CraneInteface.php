<?php

namespace AOC\D5\P1;

interface CraneInteface
{
    public function move(
        Cargo $cargo,
        int $from,
        int $to,
        int $quantity
    ): Cargo;
}
