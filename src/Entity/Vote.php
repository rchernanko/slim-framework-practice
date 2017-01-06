<?php

namespace BusuuTest\Entity;

class Vote
{
    /**
     * A list of users that have voted on a given exercise
     * @var array
     */
    private $userIds = [];

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
     * @return array
     */
    private function getUserIds()
    {
        return $this->userIds;
    }

    /**
     * @param $userId
     */
    public function addUserIdToArray($userId) //TODO rename this
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