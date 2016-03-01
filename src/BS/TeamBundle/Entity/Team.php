<?php

namespace BS\TeamBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Team
 *
 * @ORM\Table(name="team")
 * @ORM\Entity(repositoryClass="BS\TeamBundle\Repository\TeamRepository")
 */
class Team
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="competitionId", type="string", length=255)
     */
    private $competitionId;

    /**
     * @var string
     *
     * @ORM\Column(name="homeVictory", type="string", length=255, nullable=true)
     */
    private $homeVictory;

    /**
     * @var int
     *
     * @ORM\Column(name="homeNull", type="integer", nullable=true)
     */
    private $homeNull;

    /**
     * @var int
     *
     * @ORM\Column(name="homeDefeat", type="integer", nullable=true)
     */
    private $homeDefeat;

    /**
     * @var int
     *
     * @ORM\Column(name="outsideVictory", type="integer", nullable=true)
     */
    private $outsideVictory;

    /**
     * @var int
     *
     * @ORM\Column(name="outsideNull", type="integer", nullable=true)
     */
    private $outsideNull;

    /**
     * @var int
     *
     * @ORM\Column(name="outsideDefeat", type="integer", nullable=true)
     */
    private $outsideDefeat;

    /**
     * @var int
     *
     * @ORM\Column(name="rank", type="integer", nullable=true)
     */
    private $rank;

    /**
     * @var int
     *
     * @ORM\Column(name="outsideRank", type="integer", nullable=true)
     */
    private $outsideRank;

    /**
     * @var int
     *
     * @ORM\Column(name="homeRank", type="integer", nullable=true)
     */
    private $homeRank;

    /**
     * @var int
     *
     * @ORM\Column(name="homePoints", type="integer", nullable=true)
     */
    private $homePoints;

    /**
     * @var int
     *
     * @ORM\Column(name="outsidePoints", type="integer", nullable=true)
     */
    private $outsidePoints;

    /**
     * @var int
     *
     * @ORM\Column(name="points", type="integer", nullable=true)
     */
    private $points;

    /**
     * @var int
     *
     * @ORM\Column(name="series", type="integer", nullable=true)
     */
    private $series;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Team
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set competitionId
     *
     * @param string $competitionId
     *
     * @return Team
     */
    public function setCompetitionId($competitionId)
    {
        $this->competitionId = $competitionId;

        return $this;
    }

    /**
     * Get competitionId
     *
     * @return string
     */
    public function getCompetitionId()
    {
        return $this->competitionId;
    }

    /**
     * Set homeVictory
     *
     * @param int $homeVictory
     *
     * @return Team
     */
    public function setHomeVictory($homeVictory)
    {
        $this->homeVictory = $homeVictory;

        return $this;
    }

    /**
     * Get homeVictory
     *
     * @return int
     */
    public function getHomeVictory()
    {
        return $this->homeVictory;
    }

    /**
     * Set homeDefeat
     *
     * @param int $homeDefeat
     *
     * @return Team
     */
    public function setHomeDefeat($homeDefeat)
    {
        $this->homeDefeat = $homeDefeat;

        return $this;
    }

    /**
     * Get homeDefeat
     *
     * @return int
     */
    public function getHomeDefeat()
    {
        return $this->homeDefeat;
    }

    /**
     * Set outsideVictory
     *
     * @param int $outsideVictory
     *
     * @return Team
     */
    public function setOutsideVictory($outsideVictory)
    {
        $this->outsideVictory = $outsideVictory;

        return $this;
    }

    /**
     * Get outsideVictory
     *
     * @return int
     */
    public function getOutsideVictory()
    {
        return $this->outsideVictory;
    }

    /**
     * Set outsideDefeat
     *
     * @param int $outsideDefeat
     *
     * @return Team
     */
    public function setOutsideDefeat($outsideDefeat)
    {
        $this->outsideDefeat = $outsideDefeat;

        return $this;
    }

    /**
     * Get outsideDefeat
     *
     * @return int
     */
    public function getOutsideDefeat()
    {
        return $this->outsideDefeat;
    }

    /**
     * Set rank
     *
     * @param int $rank
     *
     * @return Team
     */
    public function setRank($rank)
    {
        $this->rank = $rank;

        return $this;
    }

    /**
     * Get rank
     *
     * @return int
     */
    public function getRank()
    {
        return $this->rank;
    }

    /**
     * Set points
     *
     * @param int $points
     *
     * @return Team
     */
    public function setPoints($points)
    {
        $this->points = $points;

        return $this;
    }

    /**
     * Get points
     *
     * @return int
     */
    public function getPoints()
    {
        return $this->points;
    }

    /**
     * Set homeNull
     *
     * @param int $homeNull
     *
     * @return Team
     */
    public function setHomeNull($homeNull)
    {
        $this->homeNull = $homeNull;

        return $this;
    }

    /**
     * Get homeNull
     *
     * @return int
     */
    public function getHomeNull()
    {
        return $this->homeNull;
    }

    /**
     * Set outsideNull
     *
     * @param int $outsideNull
     *
     * @return Team
     */
    public function setOutsideNull($outsideNull)
    {
        $this->outsideNull = $outsideNull;

        return $this;
    }

    /**
     * Get outsideNull
     *
     * @return int
     */
    public function getOutsideNull()
    {
        return $this->outsideNull;
    }

    /**
     * Set outsideRank
     *
     * @param int $outsideRank
     *
     * @return Team
     */
    public function setOutsideRank($outsideRank)
    {
        $this->outsideRank = $outsideRank;

        return $this;
    }

    /**
     * Get outsideRank
     *
     * @return int
     */
    public function getOutsideRank()
    {
        return $this->outsideRank;
    }

    /**
     * Set homeRank
     *
     * @param int $homeRank
     *
     * @return Team
     */
    public function setHomeRank($homeRank)
    {
        $this->homeRank = $homeRank;

        return $this;
    }

    /**
     * Get homeRank
     *
     * @return int
     */
    public function getHomeRank()
    {
        return $this->homeRank;
    }

    /**
     * Set homePoints
     *
     * @param int $homePoints
     *
     * @return Team
     */
    public function setHomePoints($homePoints)
    {
        $this->homePoints = $homePoints;

        return $this;
    }

    /**
     * Get homePoints
     *
     * @return int
     */
    public function getHomePoints()
    {
        return $this->homePoints;
    }

    /**
     * Set outsidePoints
     *
     * @param int $outsidePoints
     *
     * @return Team
     */
    public function setOutsidePoints($outsidePoints)
    {
        $this->outsidePoints = $outsidePoints;

        return $this;
    }

    /**
     * Get outsidePoints
     *
     * @return int
     */
    public function getOutsidePoints()
    {
        return $this->outsidePoints;
    }

    /**
     * Set series
     *
     * @param string $series
     *
     * @return Team
     */
    public function setSeries($series)
    {
        $this->series = $series;

        return $this;
    }

    /**
     * Get series
     *
     * @return string
     */
    public function getSeries()
    {
        return $this->series;
    }
}
