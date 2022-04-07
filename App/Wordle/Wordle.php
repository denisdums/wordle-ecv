<?php

declare(strict_types=1);

namespace App\Wordle;

class Wordle
{
    public Game $game;
    public string $cookieName = 'WordleGame';

    public function __construct()
    {
        $this->setGame($this->hasSave() ? $this->getSave() : new Game());
    }

    public function getGame(): Game
    {
        return $this->game;
    }

    public function setGame(Game $game)
    {
        $this->game = $game;
    }

    /**
     * Check if we have submitted word
     * @return bool
     */
    public function hasNewProposal(): bool
    {
        return isset($_POST['wordle']);
    }

    /**
     * Retrieve submitted word to a Proposal Object
     * @return Proposal
     */
    public function getNewProposal(): Proposal
    {
        $proposalWord = implode('', $_POST['wordle']);
        $proposalWord = strtolower($proposalWord);
        return new Proposal($proposalWord);
    }

    /**
     * Compile current game to a serialized minimised array
     * @return string
     */
    public function compileSave(): string
    {
        $game = [
            'word' => $this->game->word->word,
            'proposals' => [],
        ];

        foreach ($this->game->proposals as $proposal) {
            $game['proposals'][] = $proposal->word;
        }
        return serialize($game);
    }

    /**
     * Decompile serialized array to a Game object
     * @param $compiledSave
     * @return Game
     */
    public function decompileSave($compiledSave): Game
    {
        $saveDecompiled = unserialize($compiledSave);
        $savedGame = new Game($saveDecompiled['word']);

        foreach ($saveDecompiled['proposals'] as $proposal) {
            $savedGame->addProposal(new Proposal($proposal));
            $savedGame->checkLastProposal();
        }

        return $savedGame;
    }

    /**
     * Save compiled game in a cookie
     */
    public function save()
    {
        $saveCompiled = $this->compileSave();
        setcookie($this->cookieName, $saveCompiled, time() + 3600, '/');
    }

    /**
     * Check if there are a save in the cookies
     * @return bool
     */
    public function hasSave(): bool
    {
        return isset($_COOKIE[$this->cookieName]);
    }

    /**
     * Get a decompiled save from the save cookie
     * @return Game
     */
    public function getSave(): Game
    {
        $saveCompiled = $_COOKIE[$this->cookieName];
        return $this->decompileSave($saveCompiled);
    }

    /**
     * Delete game cookie for reset a game
     */
    public function reset()
    {
        if (isset($_COOKIE[$this->cookieName])) {
            unset($_COOKIE[$this->cookieName]);
            setcookie($this->cookieName, '', -1);
        }
    }
}