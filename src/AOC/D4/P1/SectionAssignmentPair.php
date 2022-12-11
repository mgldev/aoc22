<?php

namespace AOC\D4\P1;

/**
 * Class SectionAssignmentPair
 *
 * @package AOC\D4\P1
 */
class SectionAssignmentPair
{
    /**
     * @param SectionAssignment $a
     * @param SectionAssignment $b
     */
    public function __construct(protected SectionAssignment $a, protected SectionAssignment $b)
    {
    }

    /**
     * @return bool
     */
    public function hasFullyOverlappingAssignment(): bool
    {
        return $this->a->fullyContains($this->b) || $this->b->fullyContains($this->a);
    }

    /**
     * @return bool
     */
    public function hasOverlappingAssignment(): bool
    {
        return $this->a->overlaps($this->b) || $this->b->overlaps($this->a);
    }

    /**
     * @param string $input
     *
     * @return static
     */
    public static function fromString(string $input): static
    {
        [$a, $b] = explode(',', $input);

        return new self(SectionAssignment::fromString($a), SectionAssignment::fromString($b));
    }
}
