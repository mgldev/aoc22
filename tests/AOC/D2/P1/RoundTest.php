<?php

namespace Tests\AOC\D2\P1;

use AOC\D2\P1\Hand;
use AOC\D2\P1\Hand\Paper;
use AOC\D2\P1\Hand\Rock;
use AOC\D2\P1\Hand\Scissors;
use AOC\D2\P1\Round;
use PHPUnit\Framework\TestCase;

/**
 * Class RoundTest
 *
 * ./vendor/bin/phpunit --filter RoundTest
 *
 * @package Tests\AOC\P2\P1
 */
class RoundTest extends TestCase
{
    /**
     * @return array[]
     */
    public static function scoreDataProvider(): array
    {
        return [
            [
                new Rock(),
                new Paper(),
                8
            ],
            [
                new Paper(),
                new Rock(),
                1
            ],
            [
                new Scissors(),
                new Scissors(),
                6
            ]
        ];
    }

    /**
     * ./vendor/bin/phpunit --filter RoundTest::testScore
     *
     * @dataProvider scoreDataProvider
     *
     * @param Hand $theirs
     * @param Hand $mine
     * @param int $expectedScore
     *
     * @return void
     */
    public function testScore(Hand $theirs, Hand $mine, int $expectedScore): void
    {
        $round = new Round($theirs, $mine);

        $this->assertEquals($expectedScore, $round->getScore());
    }
}
