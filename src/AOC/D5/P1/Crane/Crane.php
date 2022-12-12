<?php

namespace AOC\D5\P1\Crane;

use AOC\D5\P1\Cargo;
use AOC\D5\P1\CraneInteface;
use InvalidArgumentException;

abstract class Crane implements CraneInteface
{
    public function moveByInstruction(Cargo $cargo, string $instruction): Cargo
    {
        $params = [];

        if (!$this->isValidInstruction($instruction, $params)) {
            throw new InvalidArgumentException('Invalid instruction provided');
        }

        return $this->move($cargo, (int) $params['from'], (int) $params['to'], (int) $params['qty']);
    }

    public function isValidInstruction(string $instruction, array &$matches = []): bool
    {
        return (bool) preg_match(
            '/move (?<qty>\d+) from (?<from>\d+) to (?<to>\d+)/',
            $instruction,
            $matches
        );
    }
}
