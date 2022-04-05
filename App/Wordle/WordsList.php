<?php

declare(strict_types=1);

namespace App\Wordle;

class WordsList
{
    public static ?object $_instance = null;
    public array $list;

    public function __construct(){
        $this->initList();
    }
    public static function get(): array
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new self();
        }
        return self::$_instance->getList();
    }

    public function initList() {
        $list = $this->loadList();
        $this->setList($list);
    }

    public function loadList() {
        $wordsFileContent = file_get_contents(WORDS_FILE);
        $wordsObject = json_decode($wordsFileContent);
        return $wordsObject->words ?? null;
    }

    public function setList($list) {
        $this->list = $list;
    }

    public function getList() {
        return $this->list;
    }
}