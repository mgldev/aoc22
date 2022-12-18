<?php

namespace AOC\D12\P1;

/**
 * Class Path
 *
 * @package AOC\D12\P1
 */
class Path
{
    /** @var string */
    private string $uniqid;

    /** @var Point[] */
    private array $visited = [];

    /**
     * Path constructor
     *
     * @param array $visited    Initial array of visited nodes
     */
    public function __construct(array $visited = [])
    {
        $this->uniqid = uniqid('path-');

        foreach ($visited as $point) {
            $this->visited[(string) $point] = $point;
        }
    }

    /**
     * @return string
     */
    public function getUniqid(): string
    {
        return $this->uniqid;
    }

    /**
     * Get the visited nodes in this path
     *
     * @return Point[]
     */
    public function getVisited(): array
    {
        return $this->visited;
    }

    /**
     * @return int
     */
    public function getStepCount(): int
    {
        return count($this->visited);
    }

    /**
     * @return Point|null
     */
    public function latest(): ?Point
    {
        return end($this->visited);
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->uniqid . ': ' . implode(' -> ', $this->visited);
    }
}
