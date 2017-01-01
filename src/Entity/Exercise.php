<?php

namespace BusuuTest\Entity;


class Exercise
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var User
     */
    private $author;

    /**
     * @var string
     */
    private $text;

    /**
     * @var int
     */
    private $totalUpVotes;

    /**
     * @var int
     */
    private $totalDownVotes;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return User
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * @param int $author
     */
    public function setAuthor($author)
    {
        $this->author = $author;
    }

    /**
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @param string $text
     */
    public function setText($text)
    {
        $this->text = $text;
    }

    /**
     * @return int
     */
    public function getTotalUpVotes()
    {
        return $this->totalUpVotes;
    }

    /**
     * @param int $totalUpVotes
     */
    public function setTotalUpVotes($totalUpVotes)
    {
        $this->totalUpVotes = $totalUpVotes;
    }

    /**
     * @return int
     */
    public function getTotalDownVotes()
    {
        return $this->totalDownVotes;
    }

    /**
     * @param int $totalDownVotes
     */
    public function setTotalDownVotes($totalDownVotes)
    {
        $this->totalDownVotes = $totalDownVotes;
    }
}