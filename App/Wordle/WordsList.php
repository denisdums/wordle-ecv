<?php

declare(strict_types=1);

namespace App\Wordle;

class WordsList
{
    public array $list;

    /**
     * WordList constructor
     */
    public function __construct()
    {
        $list = $this->loadList();
        $this->setList($list);
    }

    /**
     * Retrieve a word list from the words file set in /Config/vars.php
     * @return array|null
     */
    public function loadList(): ?array
    {
        $wordsFileContent = file_get_contents(WORDS_FILE);
        $wordsObject = json_decode($wordsFileContent);
        return $wordsObject->words ?? null;
    }

    /**
     * List setter
     * @param $list
     */
    public function setList($list)
    {
        $this->list = $list;
    }

    /**
     * List getter
     * @return array
     */
    public function getList(): array
    {
        return $this->list;
    }

    /**
     * Retrieve a random word from the wordlist
     * @return string
     */
    public function pickWord(): string
    {
        $list = $this->getList();
        $randomKey = array_rand($list, 1);
        return $list[$randomKey];
    }
}