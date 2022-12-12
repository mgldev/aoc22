<?php

namespace AOC\D2\P1;

/**
 * Class StrategyGuide
 *
 * @package AOC\D2\P1
 */
class StrategyGuide
{
    /**
     * StrategyGuide constructor
     *
     * @param array $rounds
     */
    public function __construct(array $rounds)
    {
        foreach ($rounds as $round) {
            $this->addRound($round);
        }
    }

    /**
     * @param Round $round
     *
     * @return $this
     */
    public function addRound(Round $round): self
    {
        $this->rounds[] = $round;

        return $this;
    }

    /**
     * @return int
     */
    public function getTotalScore(): int
    {
        return array_sum(array_map(fn (Round $round) => $round->getScore(), $this->rounds));
    }
}