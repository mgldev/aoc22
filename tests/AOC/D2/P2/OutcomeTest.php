<?php

namespace Tests\AOC\D2\P2;

use AOC\D2\P1\Hand;
use AOC\D2\P1\Hand\Paper;
use AOC\D2\P1\Hand\Rock;
use AOC\D2\P1\Hand\Scissors;
use AOC\D2\P2\Outcome;
use PHPUnit\Framework\TestCase;

/**
 * Class OutcomeTest
 *
 * ./vendor/bin/phpunit --filter OutcomeTest
 *
 * @package Tests\AOC\P2\P1
 */
class OutcomeTest extends TestCase
{
    /**
     * @return array[]
     */
    public static function outcomeDataProvider(): array
    {
        return [
            [
                Outcome::WIN,
                new Rock(),
                new Paper(),
            ],
            [
                Outcome::WIN,
                new Paper(),
                new Scissors(),
            ],
            [
                Outcome::WIN,
                new Scissors(),
                new Rock(),
            ],
            [
                Outcome::DRAW,
                new Rock(),
                new Rock(),
            ],
            [
                Outcome::DRAW,
                new Paper(),
                new Paper(),
            ],
            [
                Outcome::DRAW,
                new Scissors(),
                new Scissors(),
            ],
            [
                Outcome::LOSE,
                new Rock(),
                new Scissors(),
            ],
            [
                Outcome::LOSE,
                new Paper(),
                new Rock(),
            ],
            [
                Outcome::LOSE,
                new Scissors(),
                new Paper(),
            ],
        ];
    }

    /**
     * ./vendor/bin/phpunit --filter OutcomeTest::testForHand
     *
     * @dataProvider outcomeDataProvider
     *
     * @param Outcome $outcome
     * @param Hand $givenHand
     * @param Hand $expectedHand
     *
     * @return void
     */
    public function testForHand(Outcome $outcome, Hand $givenHand, Hand $expectedHand): void
    {
        $hand = $outcome->forHand($givenHand);

        $this->assertTrue($hand->matches($expectedHand));
    }
}
