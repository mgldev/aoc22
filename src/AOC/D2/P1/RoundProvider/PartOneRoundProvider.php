<?php

namespace AOC\D2\P1\RoundProvider;

use AOC\D2\P1\Hand;
use AOC\D2\P1\Hand\Paper;
use AOC\D2\P1\Hand\Rock;
use AOC\D2\P1\Hand\Scissors;
use AOC\D2\P1\Round;
use AOC\D2\P1\RoundProviderInterface;
use AOC\Helper\InputReader;

class PartOneRoundProvider implements RoundProviderInterface
{
    public function __construct(private string $filename)
    {
    }

    public function provide(): array
    {
        $rounds = [];

        foreach (array_filter(InputReader::fileToLines($this->filename)) as $line) {
            [$theirs, $mine] = explode(' ', $line);
            $rounds[] = new Round(
                self::getHandByIdentifier($theirs),
                self::getHandByIdentifier($mine),
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
            'A', 'X' => new Rock(),
            'B', 'Y' => new Paper(),
            'C', 'Z' => new Scissors()
        };
    }
}
