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
    private object $checkSteps;

    public function __construct()
    {
        $this->attempts = 6;
        $this->proposals = [];
        $list = new WordsList();
        $this->word = new Word($list->pickWord());
    }

    public function check()
    {
        $this->setCheckSteps();
        return $this->checkSteps->handle($this);
    }

    public function setCheckSteps()
    {
        $checkLength = new CheckLengthAbstractHandler();
        $checkProposals = new CheckProposalsAbstractHandler();
        $this->checkSteps = $checkLength->setNext($checkProposals);
    }

    public function addProposal($proposal){
        return $this->proposals[] = $proposal;
    }
}