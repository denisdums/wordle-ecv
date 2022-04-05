<?php

declare(strict_types=1);

namespace App\Wordle\Check;

use App\Wordle\Game;

class CheckProposalsAbstractHandler extends AbstractHandler
{
    public function handle(Game $game): ?string
    {
        if ($game->proposals > 0){
            var_dump($game->proposals);
            return '';
        } else {
            return parent::handle($game);
        }
    }
}