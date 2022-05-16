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
     */
    public function __construct(string $letter, int $position)
    {
        $this->setLetter($letter);
        $this->setPosition($position);
        $this->setStatus(0);
    }

    /**
     * Check letter position in a given word and update is status.
     */
    public function check(Word $word): self
    {
        $letterPositions = [];

        foreach ($word->getLetters() as $position => $letter) {
            if ($letter->getLetter() === $this->getLetter()) {
                $letterPositions[] = $position;
            }
        }

        if (\count($letterPositions) === 0) {
            return $this;
        }

        $this->setStatus(2);

        if (\is_int(array_search($this->getPosition(), $letterPositions, true))) {
            $this->setStatus(1);
        }

        return $this;
    }

    /**
     * Letter setter.
     */
    public function setLetter(string $letter): void
    {
        $this->letter = $letter;
    }

    /**
     * Letter getter.
     */
    public function getLetter(): ?string
    {
        return $this->letter ?? null;
    }

    /**
     * Status setter
     * Status : 0 = not existing, 1 = existing and at good position, 2 = existing but not at good position.
     */
    public function setStatus(int $status): void
    {
        if (!in_array($status, [0, 1, 2])){
            throw new \Exception('expected 0 = not existing, 1 = existing and at good position, 2 = existing but not at good position.');
        }

        $this->status = $status;
    }

    /**
     * Status getter.
     */
    public function getStatus(): int
    {
        return $this->status ?? 0;
    }

    /**
     * Position setter.
     */
    public function setPosition(int $position): void
    {
        $this->position = $position;
    }

    /**
     * Position getter.
     */
    public function getPosition(): int
    {
        return $this->position ?? 0;
    }
}
