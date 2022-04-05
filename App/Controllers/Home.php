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
        $game = Wordle::init();

        if (Wordle::hasProposal()){
            $game->addProposal(Wordle::getProposal());
            $game->check();
        }

        $data = ['game' => $game];
        View::render($this->view, $data);
    }

}