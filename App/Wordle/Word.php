<?php

declare(strict_types=1);

namespace App\Wordle;

class Word
{
    public static ?object $_instance = null;
    public string $word;
    public int $length;
    public array $letters;

    public function __construct()
    {
        $this->initWord();
    }

    public static function get(): Word
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    public function initWord()
    {
        $word = $this->pickWord();
        $this->setWord($word);
        $this->setLength($word);
        $this->setLetters($word);
    }

    public function pickWord()
    {
        $list = WordsList::get();
        $randomKey = array_rand($list, 1);
        return $list[$randomKey];
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
        foreach (str_split($word) as $letter){
            $lettersArray[] = new Letter($letter);
        }
        $this->letters = $lettersArray;
    }

    public function getLetters(): array
    {
        return $this->letters;
    }
}