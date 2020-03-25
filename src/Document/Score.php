<?php

namespace App\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/**
 * @MongoDB\Document(repositoryClass="App\Repository\ScoreRepository")
 */
class Score
{
    /**
     * @MongoDB\Id
     */
    protected $id;

    /**
     * @MongoDB\Field(type="string")
     */
    protected $username;

    /**
     * @MongoDB\Field(type="string")
     */
    protected $userId;

    /**
     * @MongoDB\Field(type="string")
     */
    protected $scoreId;

    /**
     * @MongoDB\Field(type="int")
     */
    protected $score;

    /**
     * @MongoDB\Field(type="date")
     */
    protected $created;

    /**
     * @MongoDB\Field(type="date")
     */
    protected $finished;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return Score
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param mixed $username
     * @return Score
     */
    public function setUsername($username)
    {
        $this->username = $username;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @param mixed $userId
     * @return Score
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getScoreId()
    {
        return $this->scoreId;
    }

    /**
     * @param mixed $scoreId
     * @return Score
     */
    public function setScoreId($scoreId)
    {
        $this->scoreId = $scoreId;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getScore()
    {
        return $this->score;
    }

    /**
     * @param mixed $score
     * @return Score
     */
    public function setScore($score)
    {
        $this->score = $score;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * @param mixed $created
     * @return Score
     */
    public function setCreated($created)
    {
        $this->created = $created;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getFinished()
    {
        return $this->finished;
    }

    /**
     * @param mixed $finished
     * @return Score
     */
    public function setFinished($finished)
    {
        $this->finished = $finished;
        return $this;
    }

}