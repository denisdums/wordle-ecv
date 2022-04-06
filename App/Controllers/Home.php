<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Helpers\View;
use App\Wordle\Word;
use App\Wordle\Wordle;

class Home implements Controller
{

    public string $view = 'home';

    public function render()
    {
        $wordle = new Wordle();
        $game = $wordle->getGame();
        var_dump(count( $game->proposals));

        if ($wordle->hasNewProposal()) {
            // add the new proposal to the game
            $game->addProposal($wordle->getNewProposal());
            // check the proposal
            //$game->checkLastProposal();
            // update the game
            $wordle->setGame($game);
        }

        $wordle->save();
        $data = ['game' => $game];
        View::render($this->view, $data);
    }

}