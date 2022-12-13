<?php

namespace AOC\D7\P1;

/**
 * Class File
 *
 * @package AOC\D7\P1;
 */
class File
{
    /**
     * File constructor
     *
     * @param string $name
     * @param int $size
     */
    public function __construct(private readonly string $name, private readonly int $size)
    {
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return int
     */
    public function getSize(): int
    {
        return $this->size;
    }
}
