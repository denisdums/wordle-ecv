<?php

declare(strict_types=1);

namespace App\Wordle;

class Letter
{
    public string $letter;
    public int $status;
    public int $position;

    /**
     * Letter constructor.
     * @param string $letter
     * @param int $position
     */
    public function __construct(string $letter, int $position)
    {
        $this->setLetter($letter);
        $this->setPosition($position);
        $this->setStatus(0);
    }

    /**
     * @param Word $word current's Game Word
     * @return Letter
     */
    public function check(Word $word)
    {
        $letterPosition = null;

        foreach ($word->letters as $position => $letter) {
            if ($letter->letter === $this->letter) {
                $letterPosition = $position;
            }
        }

        if (is_int($letterPosition)) {
            if ($letterPosition === $this->position) {
                $this->setStatus(1);
            } else {
                $this->setStatus(2);
            }
        }
        return $this;
    }

    public function setLetter(string $letter)
    {
        $this->letter = $letter;
    }

    public function getLetter(): ?string
    {
        return $this->letter ?? null;
    }

    public function setStatus(int $status)
    {
        $this->status = $status;
    }

    public function getStatus(): ?int
    {
        return $this->status ?? 0;
    }

    public function setPosition(int $status)
    {
        $this->position = $status;
    }

    public function getPosition(): ?int
    {
        return $this->position ?? null;
    }
}