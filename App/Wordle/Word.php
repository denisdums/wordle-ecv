<?php

declare(strict_types=1);

namespace App\Wordle;

class Word
{
    public string $word;
    public int $length;
    public array $letters;
    public int $status;

    /**
     * Word constructor.
     */
    public function __construct(string $word)
    {
        $this->setWord($word);
        $this->setLength($word);
        $this->setLetters($this->processLetters($word));
        $this->setStatus(0);
    }

    /**
     * Word setter.
     *
     * @param $word
     */
    public function setWord($word): void
    {
        $this->word = $word;
    }

    /**
     * Word getter.
     */
    public function getWord(): string
    {
        return $this->word;
    }

    /**
     * Length setter.
     *
     * @param $word
     */
    public function setLength($word): void
    {
        $this->length = \strlen($word);
    }

    /**
     * Length getter.
     */
    public function getLength(): int
    {
        return $this->length;
    }

    /**
     * Letters processor.
     */
    public function processLetters(string $word): array
    {
        $lettersArray = [];
        foreach (str_split($word) as $position => $letter) {
            $lettersArray[] = new Letter($letter, $position);
        }

        return $lettersArray;
    }

    /**
     * Letters setter.
     */
    public function setLetters(array $lettersArray): void
    {
        $this->letters = $lettersArray;
    }

    /**
     * Letters getter.
     */
    public function getLetters(): array
    {
        return $this->letters;
    }

    /**
     * Status setter
     * Status : 0 = not found, 1 = found.
     */
    public function setStatus(int $status): void
    {
        if (!in_array($status, [0, 1])){
            throw new \Exception('expected 0 = not found, 1 = found.');
        }

        $this->status = $status;
    }

    /**
     * Status getter.
     */
    public function getStatus(): int
    {
        return $this->status;
    }
}
