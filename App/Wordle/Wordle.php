<?php

declare(strict_types=1);

namespace App\Wordle;

class Wordle
{
    public Game $game;
    public string $cookieName = 'WordleGame';

    public function __construct()
    {
        $this->setGame($this->existingGame() ?? new Game());
    }

    public function getGame(): Game
    {
        return $this->game;
    }

    public function setGame(Game $game)
    {
        $this->game = $game;
    }

    public function existingGame()
    {
        if (isset($_COOKIE[$this->cookieName])) {
            $gameCookie = $_COOKIE[$this->cookieName];
            $gameCookieObject = unserialize($gameCookie);
            return is_a($gameCookieObject, 'App\Wordle\Game') ? $gameCookieObject : null;
        }

        /*if (isset($_SESSION[$this->cookieName])) {
            $gameCookie = $_SESSION[$this->cookieName];
            $gameCookieObject = unserialize($gameCookie);
            return is_a($gameCookieObject, 'App\Wordle\Game') ? $gameCookieObject : null;
        }*/

        return null;
    }

    public function save()
    {
        var_dump('je save avec ' . count($this->game->proposals));
        $gameSerialized = serialize($this->game);
        setcookie($this->cookieName, $gameSerialized, time() + 3600 , '/');
        //$_SESSION[$this->cookieName] = $gameSerialized;
        return $this->game;
    }

    public function reset()
    {
        if (isset($_COOKIE[$this->cookieName])) {
            unset($_COOKIE[$this->cookieName]);
            setcookie($this->cookieName, '', -1);
        }
    }

    public function hasNewProposal()
    {
        return isset($_POST['wordle']);
    }

    public function getNewProposal()
    {
        $proposalWord = implode('', $_POST['wordle']);
        return new Proposal($proposalWord);
    }
}