<?php

namespace BusuuTest\Entity;

class Vote
{
    /**
     * @var int
     */
    private $totalVotes;

    /**
     * @var int
     */
    private $totalPositiveVotes;

    /**
     * @var int
     */
    private $totalNegativeVotes;

    /**
     * @return int
     */
    public function getTotalVotes()
    {
        return $this->totalVotes;
    }

    /**
     * @param int $totalVotes
     */
    public function setTotalVotes($totalVotes)
    {
        $this->totalVotes = $totalVotes;
    }

    /**
     * @return int
     */
    public function getTotalPositiveVotes()
    {
        return $this->totalPositiveVotes;
    }

    /**
     * @param int $totalPositiveVotes
     */
    public function setTotalPositiveVotes($totalPositiveVotes)
    {
        $this->totalPositiveVotes = $totalPositiveVotes;
    }

    /**
     * @return int
     */
    public function getTotalNegativeVotes()
    {
        return $this->totalNegativeVotes;
    }

    /**
     * @param int $totalNegativeVotes
     */
    public function setTotalNegativeVotes($totalNegativeVotes)
    {
        $this->totalNegativeVotes = $totalNegativeVotes;
    }
}