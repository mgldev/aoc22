<?php

namespace AOC\D12\P1\Grid;

/**
 * Class ElevationPoint
 *
 * @package AOC\D12\P1\Grid
 */
class ElevationPoint
{
    /** @var int */
    private int $height;

    /**
     * ElevationPoint
     *
     * @param string $heightChar
     */
    public function __construct(private string $heightChar)
    {
        $this->height = match ($this->heightChar) {
            'E' => 26,
            'S' => 1,
            default => ord($this->heightChar) - 96
        };
    }

    /**
     * @return int
     */
    public function getHeight(): int
    {
        return $this->height;
    }

    /**
     * @return string
     */
    public function getHeightChar(): string
    {
        return $this->heightChar;
    }
}
