<?php

namespace AOC\D12\P1\Grid;

use AOC\D12\P1\GridInterface;
use AOC\D12\P1\Point;
use AOC\Helper\InputReader;

/**
 * Class ElevationGrid
 *
 * @package AOC\D12\P1\Grid
 */
class ElevationGrid implements GridInterface
{
    /**
     * ElevationGrid constructor
     *
     * @param array $grid
     */
    public function __construct(private array $grid)
    {
    }

    /**
     * Get an elevation point for a given point
     *
     * @param Point $point
     *
     * @return ElevationPoint|null
     */
    public function getValue(Point $point): ?ElevationPoint
    {
        return $this->grid[$point->x][$point->y] ?? null;
    }

    /**
     * @return Point
     */
    public function getStartNode(): Point
    {
        $matches = $this->findByHeightChar('S');

        return array_pop($matches);
    }

    /**
     * @return Point
     */
    public function getDestinationNode(): Point
    {
        $matches = $this->findByHeightChar('E');

        return array_pop($matches);
    }

    /**
     * Find the points which match the elevation $char
     *
     * @param string $char
     *
     * @return Point[]
     */
    public function findByHeightChar(string $char): array
    {
        $matches = [];

        for ($x = 0; $x < count($this->grid); $x++) {
            for ($y = 0; $y < count($this->grid[$x]); $y++) {
                $point = new Point($x, $y);
                if ($this->getValue($point)->getHeightChar() === $char) {
                    $matches[] = $point;
                }
            }
        }

        return $matches;
    }

    /**
     * Find the points which match the elevation $char
     *
     * @param string $char
     *
     * @return Point[]
     */
    public function findByHeight(int $height): array
    {
        $matches = [];

        for ($x = 0; $x < count($this->grid); $x++) {
            for ($y = 0; $y < count($this->grid[$x]); $y++) {
                $point = new Point($x, $y);
                if ($this->getValue($point)->getHeight() === $height) {
                    $matches[] = $point;
                }
            }
        }

        return $matches;
    }

    /**
     * Create a grid instance for a given input file
     *
     * @param string $filename
     *
     * @return static
     */
    public static function fromInput(string $filename): self
    {
        $grid = [];

        foreach (InputReader::fileToLines($filename) as $y => $line) {
            foreach (str_split($line) as $x => $heightChar) {
                $grid[$x][$y] = new ElevationPoint($heightChar);
            }
        }

        return new self($grid);
    }
}
