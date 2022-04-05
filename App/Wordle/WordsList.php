<?php

declare(strict_types=1);

namespace App\Wordle;

class WordsList
{
    public array $list;

    public function __construct()
    {
        $this->initList();
    }

    public function initList()
    {
        $list = $this->loadList();
        $this->setList($list);
    }

    public function loadList()
    {
        $wordsFileContent = file_get_contents(WORDS_FILE);
        $wordsObject = json_decode($wordsFileContent);
        return $wordsObject->words ?? null;
    }

    public function setList($list)
    {
        $this->list = $list;
    }

    public function getList()
    {
        return $this->list;
    }

    public function pickWord()
    {
        $list = $this->getList();
        $randomKey = array_rand($list, 1);
        return $list[$randomKey];
    }
}