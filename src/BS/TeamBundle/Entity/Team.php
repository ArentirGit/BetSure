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
     * @ORM\Column(name="homeVictory", type="string", length=255)
     */
    private $homeVictory;

    /**
     * @var string
     *
     * @ORM\Column(name="homeDefeat", type="string", length=255)
     */
    private $homeDefeat;

    /**
     * @var string
     *
     * @ORM\Column(name="outsideVictory", type="string", length=255)
     */
    private $outsideVictory;

    /**
     * @var string
     *
     * @ORM\Column(name="outsideDefeat", type="string", length=255)
     */
    private $outsideDefeat;

    /**
     * @var string
     *
     * @ORM\Column(name="rank", type="string", length=255)
     */
    private $rank;

    /**
     * @var string
     *
     * @ORM\Column(name="points", type="string", length=255)
     */
    private $points;

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
     * @param string $homeVictory
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
     * @return string
     */
    public function getHomeVictory()
    {
        return $this->homeVictory;
    }

    /**
     * Set homeDefeat
     *
     * @param string $homeDefeat
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
     * @return string
     */
    public function getHomeDefeat()
    {
        return $this->homeDefeat;
    }

    /**
     * Set outsideVictory
     *
     * @param string $outsideVictory
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
     * @return string
     */
    public function getOutsideVictory()
    {
        return $this->outsideVictory;
    }

    /**
     * Set outsideDefeat
     *
     * @param string $outsideDefeat
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
     * @return string
     */
    public function getOutsideDefeat()
    {
        return $this->outsideDefeat;
    }

    /**
     * Set rank
     *
     * @param string $rank
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
     * @return string
     */
    public function getRank()
    {
        return $this->rank;
    }

    /**
     * Set points
     *
     * @param string $points
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
     * @return string
     */
    public function getPoints()
    {
        return $this->points;
    }
}
