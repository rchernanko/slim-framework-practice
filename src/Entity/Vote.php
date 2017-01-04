<?php

namespace BusuuTest\Entity;

class Vote
{
    /**
     * @var array
     */
    private $userIds = [];

    /**
     * @var int
     */
    private $totalVotes;

    /**
     * @var boolean
     */
    private $isPositiveVote;

    /**
     * @return array
     */
    public function getUserIds()
    {
        return $this->userIds;
    }

    /**
     * @param array $userIds
     */
    public function setUserIds($userIds)
    {
        $this->userIds = $userIds;
    }

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
     * @return boolean
     */
    public function getIsPositiveVote()
    {
        return $this->isPositiveVote;
    }

    /**
     * @param boolean $isPositiveVote
     */
    public function setIsPositiveVote($isPositiveVote)
    {
        $this->isPositiveVote = $isPositiveVote;
    }
}