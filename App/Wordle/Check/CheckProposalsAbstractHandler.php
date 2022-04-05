<?php

declare(strict_types=1);

namespace App\Wordle\Check;

use App\Wordle\Game;

class CheckProposalsAbstractHandler extends AbstractHandler
{
    public function handle(Game $game): ?string
    {
        if ($game->attempts < 0){
            var_dump('1');
            return 'aa';
        } else {
            return parent::handle($game);
        }
    }
}