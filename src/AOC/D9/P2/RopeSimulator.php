<?php

namespace AOC\D9\P2;

use AOC\D9\P1\Coord;
use AOC\Helper\InputReader;

/**
 * Class RopeSimulator P2
 *
 * @package AOC\D9\P2
 */
class RopeSimulator
{
    /**
     * @param array $instructions
     */
    public function __construct(private array $instructions)
    {
    }

    /**
     * Simulate the rope movement
     *
     * @return int  The number of unique locations the tail has visited
     */
    public function simulate(): int
    {
        $rope = [];

        for ($i = 0; $i < 10; $i++) {
            $rope[] = new Coord(0, 0);
        }

        $visited = [(string) $rope[0]];

        foreach ($this->instructions as $instruction) {
            [$direction, $places] = explode(' ', $instruction);

            for ($i = 0; $i < $places; $i++) {
                match ($direction) {
                    'U' => $rope[0]->y++,
                    'R' => $rope[0]->x++,
                    'D' => $rope[0]->y--,
                    'L' => $rope[0]->x--,
                    default => throw new \Exception('Invalid direction')
                };

                for ($j = 0; $j < count($rope) - 1; $j++) {
                    $tmpHead = $rope[$j];
                    $tmpTail = $rope[$j + 1];

                    $diff = new Coord(
                        $tmpHead->x - $tmpTail->x,
                        $tmpHead->y - $tmpTail->y
                    );

                    $disconnected = abs($diff->x) > 1 || abs($diff->y) > 1;

                    if ($disconnected) {
                        $tmpTail->x += gmp_sign($diff->x);
                        $tmpTail->y += gmp_sign($diff->y);
                        if ($j + 1 === count($rope) - 1) {
                            $visited[] = (string) $tmpTail;
                        }
                    }
                }
            }
        }

        return count(array_unique($visited));
    }

    /**
     * @param string $filename
     *
     * @return static
     */
    public static function fromFile(string $filename): self
    {
        return new self(array_filter(InputReader::fileToLines($filename)));
    }
}
