<?php

namespace AOC\D2\P2\RoundProvider;

use AOC\D2\P1\Hand;
use AOC\D2\P1\Hand\Paper;
use AOC\D2\P1\Hand\Rock;
use AOC\D2\P1\Hand\Scissors;
use AOC\D2\P1\Round;
use AOC\D2\P1\RoundProviderInterface;
use AOC\D2\P2\Outcome;
use AOC\Helper\InputReader;

/**
 * Class PartTwoRoundProvider
 *
 * @package AOC\P2\P2
 */
class PartTwoRoundProvider implements RoundProviderInterface
{
    /**
     * @param string $filename
     */
    public function __construct(private readonly string $filename)
    {
    }

    /**
     * @return array
     */
    public function provide(): array
    {
        $rounds = [];

        foreach (array_filter(InputReader::fileToLines($this->filename)) as $line) {
            [$theirs, $desiredOutcome] = explode(' ', $line);

            $rounds[] = new Round(
                $theirHand = self::getHandByIdentifier($theirs),
                Outcome::from($desiredOutcome)->forHand($theirHand)
            );
        }

        return $rounds;
    }

    /**
     * @param string $identifier
     *
     * @return Hand
     */
    private function getHandByIdentifier(string $identifier): Hand
    {
        return match($identifier) {
            'A' => new Rock(),
            'B' => new Paper(),
            'C' => new Scissors()
        };
    }
}
