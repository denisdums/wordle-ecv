<?php

declare(strict_types=1);

namespace App\Wordle;

class Game
{
    public Word $word;
    public int $attempts;
    public array $proposals;

    public function __construct()
    {
        $this->attempts = 6;
        $this->proposals = [];
        $list = new WordsList();
        $this->word = new Word($list->pickWord());
    }

    public function checkLastProposal()
    {
        $proposal = $this->getLastProposal();

        if ($proposal->checkWord($this->word)) {
            $proposal->setStatus(1);
        }

        $proposal->checkLetters($this->word);

        $this->attempts = $this->attempts - 1;
        $this->updateLastProposal($proposal);
    }

    public function addProposal($proposal)
    {
        $this->proposals[] = $proposal;
    }

    public function hasProposals()
    {
        return count($this->proposals) > 0;
    }

    public function getLastProposal(): ?Proposal
    {
        return isset($this->proposals[$this->getLastProposalKey()]) ? $this->proposals[$this->getLastProposalKey()] : null;
    }

    public function getLastProposalKey(): ?int
    {
        return count($this->proposals);
    }

    public function updateLastProposal(Proposal $proposal)
    {
        $this->updateProposal($this->getLastProposalKey(), $proposal);
    }

    public function updateProposal(int $proposalKey, Proposal $proposal)
    {
        $this->proposals[$proposalKey] = $proposal;
    }
}