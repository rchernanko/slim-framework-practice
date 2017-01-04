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
     * @var Vote
     */
    private $vote;

    public function __construct(Vote $vote)
    {
        $this->vote = $vote;
    }

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
     * @return \BusuuTest\Entity\Vote
     */
    public function getVote()
    {
        return $this->vote;
    }

    /**
     * @param \BusuuTest\Entity\Vote $vote
     */
    public function setVote($vote)
    {
        $this->vote = $vote;
    }
}