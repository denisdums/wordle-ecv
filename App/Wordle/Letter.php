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
     * Check letter position in a given word and update is status
     * @param Word $word
     * @return Letter
     */
    public function check(Word $word): Letter
    {
        $letterPositions = [];

        foreach ($word->getLetters() as $position => $letter) {
            if ($letter->getLetter() === $this->getLetter()) {
                $letterPositions[] = $position;
            }
        }

        if (count($letterPositions) > 0) {
            if (is_int(array_search($this->getPosition(), $letterPositions))) {
                $this->setStatus(1);
            } else {
                $this->setStatus(2);
            }
        }

        return $this;
    }

    /**
     * Letter setter
     * @param string $letter
     */
    public function setLetter(string $letter)
    {
        $this->letter = $letter;
    }

    /**
     * Letter getter
     * @return string|null
     */
    public function getLetter(): ?string
    {
        return $this->letter ?? null;
    }

    /**
     * Status setter
     * Status : 0 = not existing, 1 = existing and at good position, 2 = existing but not at good position
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
        return $this->status ?? 0;
    }

    /**
     * Position setter
     * @param int $status
     */
    public function setPosition(int $status)
    {
        $this->position = $status;
    }

    /**
     * Position getter
     * @return int|null
     */
    public function getPosition(): ?int
    {
        return $this->position ?? null;
    }
}