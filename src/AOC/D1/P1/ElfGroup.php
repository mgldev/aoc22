<?php

namespace AOC\D1\P1;

use AOC\Helper\InputReader;

class ElfGroup
{
    protected $elves = [];

    public function addElf(Elf $elf): self
    {
        $this->elves[] = $elf;

        return $this;
    }

    public function getHighestCalorieCount(): int
    {
        return max(array_map(fn (Elf $elf) => $elf->getTotalCalories(), $this->elves));
    }

    public static function fromInput(string $filename): static
    {
        $lines = InputReader::fileToLines($filename);

        $group = new static();
        $elf = new Elf();

        foreach ($lines as $line) {
            if (strlen(trim($line)) === 0) {
                $group->addElf($elf);
                $elf = new Elf();
                continue;
            }

            $elf->addFood(new Food((int) $line));
        }

        return $group;
    }
}
