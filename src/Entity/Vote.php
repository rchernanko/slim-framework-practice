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
     * @param $userId
     */
    public function addUserIdToArray($userId)
    {
        $this->getUserIds()[] = $userId; //TODO not sure this will work...try out in separate project first
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
}