<?php

namespace AOC\D5\P1;

use AOC\Helper\InputReader;
use Exception;

class Cargo
{
    public function __construct(private array $stacks)
    {
    }

    /**
     * @param int $position
     *
     * @return array
     */
    public function getStack(int $position): array
    {
        return $this->stacks[$position - 1];
    }

    public function setStack(int $position, array $stack): self
    {
        $this->stacks[$position - 1] = $stack;

        return $this;
    }

    public function getStackTopsAsString(): string
    {
        return implode(array_map(fn (array $stack) => array_pop($stack), $this->stacks));
    }

    public static function fromFile(string $filename): self
    {
        $lines = [];

        foreach (InputReader::fileToLines($filename) as $line) {
            if (is_numeric(str_replace(' ', '', $line))) {
                $stackCount = (int)max(explode('   ', $line));
                $stacks = array_fill(0, $stackCount, []);
                $lines = array_reverse($lines);

                foreach ($lines as $row) {
                    $columns = str_split($row, 4);
                    foreach ($columns as $index => $value) {
                        if (trim($value) !== '') {
                            $stacks[$index][] = trim(str_replace([' ', '[', ']'], '', $value));
                        }
                    }
                }

                return new self($stacks);
            }

            $lines[] = $line;
        }

        throw new Exception('No stack definition terminator found - check file format');
    }
}