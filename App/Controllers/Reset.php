<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Wordle\Wordle;

class Reset implements Controller
{
    public string $view = '';

    public function render(): void
    {
        $wordle = new Wordle();
        $wordle->reset();
        header('Location: /');
    }
}
