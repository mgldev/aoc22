<?php

namespace AOC\D2\P2;

use AOC\D2\P1\Hand;
use AOC\D2\P1\Hand\Paper;
use AOC\D2\P1\Hand\Rock;
use AOC\D2\P1\Hand\Scissors;

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

   public function forHand(Hand $hand): Hand
   {
        return match ($this) {
            self::DRAW => $hand,
            self::WIN => $this->losesAgainst($hand),
            self::LOSE => $this->winsAgainst($hand)
        };
   }

   private function winsAgainst(Hand $hand): Hand
   {
        foreach ($this->getAllHands() as $check) {
            if ($hand->defeats($check)) {
                return $check;
            }
        }
   }

    private function losesAgainst(Hand $hand): Hand
    {
        foreach ($this->getAllHands() as $check) {
            if ($check->defeats($hand)) {
                return $check;
            }
        }
    }
}