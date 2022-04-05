<?php

declare(strict_types=1);

namespace App\Wordle;

class Letter
{
    public string $letter;

    public function __construct($letter)
    {
        $this->letter = $letter;
    }
}