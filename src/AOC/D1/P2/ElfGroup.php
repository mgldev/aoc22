<?php

namespace AOC\D1\P2;

use AOC\D1\P1\Elf;
use AOC\D1\P1\ElfGroup as ElfGroupBase;
use AOC\D1\P1\Food;
use AOC\Helper\InputReader;

class ElfGroup extends ElfGroupBase
{
    public function getCalorieCountTopElves(int $count): int
    {
        $totals = array_map(fn (Elf $elf) => $elf->getTotalCalories(), $this->elves);
        rsort($totals);

        return array_sum(array_slice($totals, 0, $count));
    }
}
