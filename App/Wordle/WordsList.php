<?php

declare(strict_types=1);

namespace App\Wordle;

class WordsList
{
    public array $list;

    /**
     * WordList constructor.
     */
    public function __construct()
    {
        $list = $this->loadList();
        $this->setList($list);
    }

    /**
     * Retrieve a word list from the words file set in /Config/vars.php.
     */
    public function loadList(): ?array // ce serait mieux de retourner un tableau vide plutôt pour une question d'homogénéité
    {
        $wordsFileContent = file_get_contents(WORDS_FILE);
        $wordsObject = json_decode($wordsFileContent);

        // éventuellement une exception, si ya un souci de fichier.

        return $wordsObject->words ?? null;
    }

    /**
     * List setter.
     *
     * @param $list
     */
    public function setList($list): void
    {
        $this->list = $list;
    }

    /**
     * List getter.
     */
    public function getList(): array
    {
        return $this->list;
    }

    /**
     * Retrieve a random word from the wordlist.
     */
    public function pickWord(): string
    {
        $list = $this->getList();
        $randomKey = array_rand($list);

        return $list[$randomKey];
    }
}
