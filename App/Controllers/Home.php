<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Helpers\View;
use App\Wordle\Wordle;

class Home implements Controller
{

    public string $view = 'home';

    public function render()
    {
        $wordle = new Wordle();
        $game = $wordle->getGame();

        if ($wordle->hasNewProposal()) {
            $game->addProposal($wordle->getNewProposal());
            $game->checkLastProposal();
            $wordle->setGame($game);
        }

        $wordle->save();

        $data = ['game' => $game];
        View::render($this->view, $data);
    }

}