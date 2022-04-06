<?php

declare(strict_types=1);

namespace App\Wordle;

class Word
{
    public string $word;
    public int $length;
    public array $letters;
    public int $status;

    public function __construct(string $word)
    {
        $this->initWord($word);
    }

    public function initWord($word)
    {
        $this->setWord($word);
        $this->setLength($word);
        $this->setLetters($word);
        $this->setStatus(0);
    }

    public function setWord($word)
    {
        $this->word = $word;
    }

    public function getWord(): string
    {
        return $this->word;
    }

    public function setLength($word)
    {
        $this->length = strlen($word);
    }

    public function getLength(): int
    {
        return $this->length;
    }

    public function setLetters($word)
    {
        $lettersArray = [];
        foreach (str_split($word) as $position => $letter) {
            $lettersArray[] = new Letter($letter, $position);
        }
        $this->letters = $lettersArray;
    }

    public function getLetters(): array
    {
        return $this->letters;
    }

    public function setStatus(int $status)
    {
        /**
         * Status : 0 = not found, 1 = found
         */
        $this->status = $status;
    }

    public function getStatus(): ?int
    {
        return $this->status ?? null;
    }
}