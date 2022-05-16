<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Helpers\View;
use App\Wordle\Wordle;

class Home implements Controller
{
    public string $view = 'home';

    public function render(): void
    {
        $wordle = new Wordle();
        $wordle->processProposal();
        $wordle->save();
        $data = ['game' => $wordle->getGame()];
        View::render($this->view, $data);
    }
}
