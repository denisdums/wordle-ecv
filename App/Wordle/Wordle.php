<?php

declare(strict_types=1);

namespace App\Wordle;

class Wordle
{
    public static Game $game;

    public static function init()
    {
        self::$game = self::existingGame() ?? self::initGame();
        return self::$game;
    }

    public static function existingGame()
    {
        if (isset($_COOKIE["WordleGame"])){
            return null;
        }
        $gameCookie = $_COOKIE["WordleGame"];
        $gameCookieObject = unserialize($gameCookie);
        return is_a($gameCookieObject, 'App\Wordle\Game') ? $gameCookieObject : null;
    }

    public static function initGame()
    {
        $game = new Game();
        $gameSerialized = serialize($game);
        setcookie("WordleGame", $gameSerialized, time() + 3600);
        return $game;
    }

    public static function hasProposal(){
        return isset($_POST['wordle']);
    }

    public static function getProposal(){
        $proposalWord = implode('',$_POST['wordle']);
        return new Word($proposalWord);
    }
}