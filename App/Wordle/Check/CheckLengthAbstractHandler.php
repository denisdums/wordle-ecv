<?php

declare(strict_types=1);

namespace App\Wordle\Check;

use App\Wordle\Game;

class CheckLengthAbstractHandler extends AbstractHandler
{
    public function handle(Game $game): ?string
    {
        if (!isset($_POST['wordle']) && count($_POST['wordle']) != $game->word->length){
            $proposal = $_POST['wordle'];
            var_dump($proposal);
            return 'cest la merde';
        } else {
            return parent::handle($game);
        }
    }
}