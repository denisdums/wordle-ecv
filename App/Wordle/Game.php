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
     */
    public function __construct(string $word = '')
    {
        $this->setAttempts(6);
        $this->setProposals([]);

        if ('' === $word) {
            $list = new WordsList();
            $word = $list->pickWord();
        }

        $this->setWord(new Word($word));
    }

    /**
     * Check and update the last proposal compared with the game word.
     */
    public function checkLastProposal(): void
    {
        // et si tu retourne null ?
        $proposal = $this->getLastProposal();

        if ($proposal->checkWord($this->getWord())) {
            $proposal->setStatus(1);
        }

        $proposal->checkLetters($this->getWord());

        $this->setAttempts($this->getAttempts() - 1);
        $this->updateLastProposal($proposal);
    }

    /**
     * Add new proposal object in the proposals array.
     */
    public function addProposal(Proposal $proposal): void
    {
        $this->proposals[] = $proposal;
    }

    /**
     * Retrieve the last proposal in the proposal array.
     */
    public function getLastProposal(): ?Proposal
    {
        return $this->proposals[$this->getLastProposalKey()] ?? null;
    }

    /**
     * Retrieve the last proposal key in the proposals array.
     *
     * @return Proposal|null
     */
    public function getLastProposalKey(): ?int
    {
        return \is_int(array_key_last($this->getProposals())) ? array_key_last($this->getProposals()) : null;
    }

    /**
     * Replace the last proposal with a given Proposal object.
     */
    public function updateLastProposal(Proposal $proposal): void
    {
        $this->updateProposal($this->getLastProposalKey(), $proposal);
    }

    /**
     * Replace the update a proposal with a given Proposal object and array key.
     */
    public function updateProposal(int $proposalKey, Proposal $proposal): void
    {
        $this->proposals[$proposalKey] = $proposal;
    }

    /**
     * Word getter.
     */
    public function getWord(): Word
    {
        return $this->word;
    }

    /**
     * Word Setter.
     */
    public function setWord(Word $word): void
    {
        $this->word = $word;
    }

    /**
     * Attempts getter.
     */
    public function getAttempts(): int
    {
        return $this->attempts;
    }

    /**
     * Attempts setter.
     */
    public function setAttempts(int $attempts): void
    {
        $this->attempts = $attempts;
    }

    /**
     * Proposal getter.
     */
    public function getProposals(): array
    {
        return $this->proposals;
    }

    /**
     * Proposals setter.
     */
    public function setProposals(array $proposals): void
    {
        $this->proposals = $proposals;
    }

    /**
     * Retrieve current Game status.
     */
    public function getGameStatus(): ?int
    {
        return $this->getLastProposal() ? $this->getLastProposal()->getStatus() : 0;
    }
}
