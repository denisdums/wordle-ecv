<?php

declare(strict_types=1);

namespace App\Wordle;

class Game
{
    public Word $word;
    public int $attempts;
    public array $proposals;

    /**
     * Game constructor.
     * @param string $word
     */
    public function __construct(string $word = '')
    {
        $this->setAttempts(6);
        $this->setProposals([]);

        if ($word === '') {
            $list = new WordsList();
            $word = $list->pickWord();
        }

        $this->setWord(new Word($word));
    }

    /**
     * Check and update the last proposal compared with the game word
     */
    public function checkLastProposal()
    {
        $proposal = $this->getLastProposal();

        if ($proposal->checkWord($this->getWord())) {
            $proposal->setStatus(1);
        }

        $proposal->checkLetters($this->getWord());

        $this->setAttempts($this->getAttempts() -1);
        $this->updateLastProposal($proposal);
    }


    /**
     * Add new proposal object in the proposals array
     * @param Proposal $proposal
     */
    public function addProposal(Proposal $proposal)
    {
        $this->proposals[] = $proposal;
    }


    /**
     * Retrieve the last proposal in the proposal array
     * @return Proposal|null
     */
    public function getLastProposal(): ?Proposal
    {
        return $this->proposals[$this->getLastProposalKey()] ?? null;
    }

    /**
     * Retrieve the last proposal key in the proposals array
     * @return Proposal|null
     */
    public function getLastProposalKey(): ?int
    {
        return is_int(array_key_last($this->getProposals())) ? array_key_last($this->getProposals()) : null;
    }

    /**
     * Replace the last proposal with a given Proposal object
     */
    public function updateLastProposal(Proposal $proposal)
    {
        $this->updateProposal($this->getLastProposalKey(), $proposal);
    }

    /**
     * Replace the update a proposal with a given Proposal object and array key
     */
    public function updateProposal(int $proposalKey, Proposal $proposal)
    {
        $this->proposals[$proposalKey] = $proposal;
    }

    /**
     * Word getter
     * @return Word
     */
    public function getWord(): Word
    {
        return $this->word;
    }

    /**
     * Word Setter
     * @param Word $word
     */
    public function setWord(Word $word): void
    {
        $this->word = $word;
    }

    /**
     * Attempts getter
     * @return int
     */
    public function getAttempts(): int
    {
        return $this->attempts;
    }

    /**
     * Attempts setter
     * @param int $attempts
     */
    public function setAttempts(int $attempts): void
    {
        $this->attempts = $attempts;
    }

    /**
     * Proposal getter
     * @return array
     */
    public function getProposals(): array
    {
        return $this->proposals;
    }

    /**
     * Proposals setter
     * @param array $proposals
     */
    public function setProposals(array $proposals): void
    {
        $this->proposals = $proposals;
    }
}