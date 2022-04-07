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
     * @param string $word
     */
    public function __construct(string $word)
    {
        $this->setWord($word);
        $this->setLength($word);
        $this->setLetters($this->processLetters($word));
        $this->setStatus(0);
    }

    /**
     * Word setter
     * @param $word
     */
    public function setWord($word)
    {
        $this->word = $word;
    }

    /**
     * Word getter
     * @return string
     */
    public function getWord(): string
    {
        return $this->word;
    }

    /**
     * Length setter
     * @param $word
     */
    public function setLength($word)
    {
        $this->length = strlen($word);
    }

    /**
     * Length getter
     * @return int
     */
    public function getLength(): int
    {
        return $this->length;
    }

    /**
     * Letters processor
     * @param string $word
     * @return array
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
     * Letters setter
     * @param array $lettersArray
     */
    public function setLetters(array $lettersArray)
    {
        $this->letters = $lettersArray;
    }

    /**
     * Letters getter
     * @return array
     */
    public function getLetters(): array
    {
        return $this->letters;
    }

    /**
     * Status setter
     * Status : 0 = not found, 1 = found
     * @param int $status
     */
    public function setStatus(int $status)
    {
        $this->status = $status;
    }

    /**
     * Status getter
     * @return int|null
     */
    public function getStatus(): ?int
    {
        return $this->status ?? null;
    }
}