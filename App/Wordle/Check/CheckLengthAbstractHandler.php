<?php

declare(strict_types=1);

namespace App\Wordle\Check;

use App\Wordle\Game;

class CheckLengthAbstractHandler extends AbstractHandler
{
    public function handle(Game $game): ?string
    {
        if(true){
            echo 'ici';
            return null;
        } else {
            return parent::handle($game);
        }
    }
}