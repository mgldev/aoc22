<?php

namespace AOC\D6\P1;

use DomainException;

/**
 * Class MarkerFinder
 *
 * @package AOC\D6\P1
 */
class MarkerFinder
{
    /**
     * MarkerFinder constructor
     *
     * @param string $buffer
     */
    public function __construct(private readonly string $buffer)
    {
    }

    /**
     * Find the first position of a unique marker for a given marker length
     *
     * @param int $markerLength
     *
     * @return int
     */
    public function find(int $markerLength): int
    {
        $input = str_split($this->buffer);
        $count = count($input);

        for ($i = 0; $i < $count; $i++) {
            if (count(array_unique(array_slice($input, $i, $markerLength))) === $markerLength) {
                return $i + $markerLength;
            }
        }

        throw new DomainException('No marker found');
    }

    /**
     * @param string $filename
     *
     * @return static
     */
    public static function fromInput(string $filename): self
    {
        return new self(file_get_contents($filename));
    }
}