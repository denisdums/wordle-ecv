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
        $game = Wordle::init();
        $game->check();
        $data = ['game' => $game];
        View::render($this->view, $data);
    }

}