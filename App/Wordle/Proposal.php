<?php

declare(strict_types=1);

namespace App\Wordle;

class Proposal extends Word
{
    public function checkWord(Word $proposal): bool
    {
        return $this->word === $proposal->word;
    }

    public function checkLetters(Word $word)
    {
        $lettersChecked = [];

        foreach ($this->letters as $position => $letter) {
            $lettersChecked[] = $letter->check($word);
        }

        $this->letters = $lettersChecked;
    }
}