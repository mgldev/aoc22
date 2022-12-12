<?php

namespace AOC\D2\P2;

use AOC\D2\P1\Hand;
use AOC\D2\P1\Hand\Paper;
use AOC\D2\P1\Hand\Rock;
use AOC\D2\P1\Hand\Scissors;

/**
 * Class Outcome
 *
 * @package AOC\P2\P2
 */
enum Outcome: string
{
   case LOSE = 'X';

   case DRAW = 'Y';

   case WIN = 'Z';

    /**
     * @return Hand[]
     */
   private function getAllHands(): array
   {
       return [
           new Rock(),
           new Paper(),
           new Scissors()
       ];
   }

    /**
     * For a given $hand, get the hand which should be played to achieve the outcome of the enum (win, draw or lose)
     *
     * @param Hand $hand    The hand that's been played
     *
     * @return Hand         The hand that should be played to achieve the outcome
     */
   public function forHand(Hand $hand): Hand
   {
        return match ($this) {
            self::DRAW => $hand,
            self::WIN => $this->winLoseOutcome($hand, true),
            self::LOSE => $this->winLoseOutcome($hand, false)
        };
   }

    /**
     * @param Hand $hand
     * @param bool $shouldWin
     *
     * @return Hand
     */
   private function winLoseOutcome(Hand $hand, bool $shouldWin): Hand
   {
       foreach ($this->getAllHands() as $check) {
           $a = $shouldWin ? $hand : $check;
           $b = $shouldWin ? $check : $hand;

           if ($a->defeats($b)) {
               return $check;
           }
       }
   }
}