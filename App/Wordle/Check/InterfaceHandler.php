<?php

declare(strict_types=1);

namespace App\Wordle\Check;

use App\Wordle\Game;

interface InterfaceHandler
{
    public function setNext(AbstractHandler $handler): AbstractHandler;

    public function handle(Game $game): ?string;
}