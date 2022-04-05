<?php

declare(strict_types=1);

namespace App\Wordle;

use App\Wordle\Check\CheckLengthAbstractHandler;
use App\Wordle\Check\CheckProposalsAbstractHandler;
use App\Wordle\Check\AbstractHandler;

class Game
{
    public Word $word;
    public int $attempts;
    public array $proposals;
    private $checkSteps;

    public function __construct()
    {
        $this->attempts = 6;
        $this->proposals = [];
        $this->word = Word::get();
    }

    public function check(){
        $this->setCheckSteps();
        $result = $this->checkSteps->handle($this);
        die();
    }

    public function setCheckSteps() {
        $checkLength = new CheckLengthAbstractHandler();
        $checkProposals = new CheckProposalsAbstractHandler();
        $this->checkSteps = $checkLength->setNext($checkProposals);
    }
}