<?php

namespace Tests\AOC\D2\P1;

use AOC\D2\P1\StrategyGuide;
use PHPUnit\Framework\TestCase;

/**
 * Class StrategyGuideTest
 *
 * ./vendor/bin/phpunit --filter StrategyGuideTest
 *
 * @package Tests\AOC\P2\P1
 */
class StrategyGuideTest extends TestCase
{
    /**
     * @return array[]
     */
    public static function totalScoreDataProvider(): array
    {
        return [
            [
                [
                    ['A', 'Y']
                ],
                8
            ],
            [
                [
                    ['B', 'X'],
                ],
                1
            ],
            [
                [
                    ['C', 'Z']
                ],
                6
            ],
            [
                [
                    ['A', 'Y'],
                    ['B', 'X'],
                    ['C', 'Z']
                ],
                15
            ]
        ];
    }

    /**
     * ./vendor/bin/phpunit --filter StrategyGuideTest::testTotalScore
     *
     * @dataProvider totalScoreDataProvider
     *
     * @param array $roundDefinitions
     * @param int $expectedTotalScore
     *
     * @return void
     */
    public function testTotalScore(array $roundDefinitions, int $expectedTotalScore): void
    {
        $strategy = StrategyGuide::fromArray($roundDefinitions);

        $this->assertEquals($expectedTotalScore, $strategy->getTotalScore());
    }
}
