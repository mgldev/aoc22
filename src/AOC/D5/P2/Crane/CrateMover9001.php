<?php

namespace AOC\D5\P2\Crane;

use AOC\D5\P1\Cargo;
use AOC\D5\P1\Crane\Crane;

class CrateMover9001 extends Crane
{
    public function move(Cargo $cargo, int $from, int $to, int $quantity): Cargo
    {
        $source = $cargo->getStack($from);
        $target = $cargo->getStack($to);

        $taken = array_splice($source, count($source) - $quantity, $quantity);
        $target = array_merge($target, $taken);

        return $cargo->setStack($from, $source)->setStack($to, $target);
    }
}
