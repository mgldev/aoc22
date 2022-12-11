<?php

namespace AOC\D4\P1;

/**
 * Class SectionAssignment
 *
 * @package AOC\D4\P1
 */
class SectionAssignment
{
    /**
     * @param int $min
     * @param int $max
     */
    public function __construct(protected int $min, protected int $max)
    {
    }

    /**
     * @return int
     */
    public function getMin(): int
    {
        return $this->min;
    }

    /**
     * @return int
     */
    public function getMax(): int
    {
        return $this->max;
    }

    /**
     * @param SectionAssignment $assignment
     *
     * @return bool
     */
    public function fullyContains(SectionAssignment $assignment): bool
    {
        return
            $assignment->getMin() >= $this->min &&
            $assignment->getMin() <= $this->max &&
            $assignment->getMax() >= $this->min &&
            $assignment->getMax() <= $this->max;
    }

    public function overlaps(SectionAssignment $assignment): bool
    {
        return
            ($assignment->getMin() >= $this->min && $assignment->getMin() <= $this->max) ||
            ($assignment->getMax() >= $this->min && $assignment->getMax() <= $this->max);
    }

    /**
     * @param string $input
     *
     * @return static
     */
    public static function fromString(string $input): self
    {
        [$min, $max] = array_map('intval', explode('-', $input));

        return new self($min, $max);
    }
}