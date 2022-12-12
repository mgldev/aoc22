<?php

namespace AOC\D5\P1\Crane;

use AOC\D5\P1\Cargo;

class CrateMover9000 extends Crane
{
    public function move(Cargo $cargo, int $from, int $to, int $quantity): Cargo
    {
        $source = $cargo->getStack($from);
        $target = $cargo->getStack($to);

        for ($i = 0; $i < $quantity; $i++) {
            $target[] = array_pop($source);
        }

        return $cargo->setStack($from, $source)->setStack($to, $target);
    }
}
