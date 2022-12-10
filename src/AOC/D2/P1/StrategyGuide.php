<?php

namespace AOC\D2\P1;

use AOC\D2\P1\Hand\Paper;
use AOC\D2\P1\Hand\Rock;
use AOC\D2\P1\Hand\Scissors;
use AOC\Helper\InputReader;

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

    /**
     * @param string $identifier
     *
     * @return Hand
     */
    private static function getHandByIdentifier(string $identifier): Hand
    {
        return match($identifier) {
          'A', 'X' => new Rock(),
          'B', 'Y' => new Paper(),
          'C', 'Z' => new Scissors()
        };
    }

    /**
     * @param string $filename
     *
     * @return static
     */
    public static function fromFile(string $filename): self
    {
        $rounds = [];

        foreach (array_filter(InputReader::fileToLines($filename)) as $line) {
            [$theirs, $mine] = explode(' ', $line);
            $rounds[] = new Round(
                self::getHandByIdentifier($theirs),
                self::getHandByIdentifier($mine),
            );
        }

        return new self($rounds);
    }

    public static function fromArray(array $roundDefinitions): self
    {
        $rounds = [];

        foreach ($roundDefinitions as $roundDefinition) {
            [$theirs, $mine] = $roundDefinition;
            $rounds[] = new Round(
                self::getHandByIdentifier($theirs),
                self::getHandByIdentifier($mine),
            );
        }

        return new self($rounds);
    }
}