<?php

declare(strict_types=1);

namespace App\Wordle\Check;

use App\Wordle\Game;

abstract class AbstractHandler implements InterfaceHandler
{
    private $nextHandler;

    public function setNext(AbstractHandler $handler): AbstractHandler
    {
        $this->nextHandler = $handler;
        return $handler;
    }

    public function handle(Game $game): ?string
    {
        if ($this->nextHandler) {
            return $this->nextHandler->handle($game);
        }

        return null;
    }
}