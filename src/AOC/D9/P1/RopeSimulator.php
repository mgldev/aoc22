<?php

namespace AOC\D9\P1;

use AOC\Helper\InputReader;

/**
 * Class RopeSimulator
 *
 * @package AOC\D9\P1
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
        $head = new Coord(0, 0);
        $tail = clone $head;
        $visited = [(string) $tail];

        foreach ($this->instructions as $instruction) {
            [$direction, $places] = explode(' ', $instruction);

            for ($i = 0; $i < $places; $i++) {
                match ($direction) {
                    'U' => $head->y++,
                    'R' => $head->x++,
                    'D' => $head->y--,
                    'L' => $head->x--,
                    default => throw new \Exception('Invalid direction')
                };

                $diff = new Coord(
                    $head->x - $tail->x,
                    $head->y - $tail->y
                );

                $disconnected = abs($diff->x) > 1 || abs($diff->y) > 1;

                if ($disconnected) {
                    $tail->x += gmp_sign($diff->x);
                    $tail->y += gmp_sign($diff->y);
                    $visited[] = (string)$tail;
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
