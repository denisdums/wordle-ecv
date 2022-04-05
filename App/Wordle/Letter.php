<?php

declare(strict_types=1);

namespace App\Wordle;

class Letter
{
    public string $letter;
    public int $status;
    public int $position;

    public function __construct(string $letter, int $position)
    {
        $this->letter = $letter;
        $this->status = 0;
        $this->position = $position;
    }
}