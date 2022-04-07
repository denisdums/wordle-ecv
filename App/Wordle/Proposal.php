<?php

declare(strict_types=1);

namespace App\Wordle;

class Proposal extends Word
{
    /**
     * Check if proposal word is the same of a given word
     * @param Word $word
     * @return bool
     */
    public function checkWord(Word $word): bool
    {
        return $this->getWord() === $word->getWord();
    }

    /**
     * Check and update the proposal array letters for a given word
     * @param Word $word
     */
    public function checkLetters(Word $word)
    {
        $lettersChecked = [];

        foreach ($this->getLetters() as $letter) {
            $lettersChecked[] = $letter->check($word);
        }

        $this->setLetters($lettersChecked);
    }
}