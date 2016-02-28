<?php

namespace BS\ResultBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Sport
 *
 * @ORM\Table(name="sport")
 * @ORM\Entity(repositoryClass="BS\ResultBundle\Repository\SportRepository")
 */
class Sport
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
     * @ORM\Column(name="sportId", type="string", length=255)
     */
    private $sportId;

    /**
     * @ORM\ManyToOne(targetEntity="BS\ResultBundle\Entity\Strategy", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $strategy;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=true)
     */
    private $name;

    /**
     * @var float
     *
     * @ORM\Column(name="moneyBet", type="float")
     */
    private $moneyBet;

    /**
     * @var float
     *
     * @ORM\Column(name="moneyEarned", type="float")
     */
    private $moneyEarned;

    /**
     * @var float
     *
     * @ORM\Column(name="returnOnInvestment", type="float")
     */
    private $returnOnInvestment;


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
     * @return Sport
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
     * Set moneyBet
     *
     * @param float $moneyBet
     *
     * @return Sport
     */
    public function setMoneyBet($moneyBet)
    {
        $this->moneyBet = $moneyBet;

        return $this;
    }

    /**
     * Get moneyBet
     *
     * @return float
     */
    public function getMoneyBet()
    {
        return $this->moneyBet;
    }

    /**
     * Set moneyEarned
     *
     * @param float $moneyEarned
     *
     * @return Sport
     */
    public function setMoneyEarned($moneyEarned)
    {
        $this->moneyEarned = $moneyEarned;

        return $this;
    }

    /**
     * Get moneyEarned
     *
     * @return float
     */
    public function getMoneyEarned()
    {
        return $this->moneyEarned;
    }

    /**
     * Set returnOnInvestment
     *
     * @param float $returnOnInvestment
     *
     * @return Sport
     */
    public function setReturnOnInvestment($returnOnInvestment)
    {
        $this->returnOnInvestment = $returnOnInvestment;

        return $this;
    }

    /**
     * Get returnOnInvestment
     *
     * @return float
     */
    public function getReturnOnInvestment()
    {
        return $this->returnOnInvestment;
    }

    /**
     * Set strategy
     *
     * @param \BS\ResultBundle\Entity\Strategy $strategy
     *
     * @return Sport
     */
    public function setStrategy(\BS\ResultBundle\Entity\Strategy $strategy)
    {
        $this->strategy = $strategy;

        return $this;
    }

    /**
     * Get strategy
     *
     * @return \BS\ResultBundle\Entity\Strategy
     */
    public function getStrategy()
    {
        return $this->strategy;
    }

    /**
     * Set sportId
     *
     * @param string $sportId
     *
     * @return Sport
     */
    public function setSportId($sportId)
    {
        $this->sportId = $sportId;

        return $this;
    }

    /**
     * Get sportId
     *
     * @return string
     */
    public function getSportId()
    {
        return $this->sportId;
    }
}
