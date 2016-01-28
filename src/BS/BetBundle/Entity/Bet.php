<?php

namespace BS\BetBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Bet
 *
 * @ORM\Table(name="bet")
 * @ORM\Entity(repositoryClass="BS\BetBundle\Repository\BetRepository")
 */
class Bet
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
     * @ORM\ManyToOne(targetEntity="BS\ResultBundle\Entity\Strategy")
     * @ORM\JoinColumn(nullable=false)
     */
    private $strategy;

    /**
     * @ORM\ManyToOne(targetEntity="BS\OfferBundle\Entity\Outcome")
     * @ORM\JoinColumn(nullable=false)
     */
    private $outcome;

    /**
     * @ORM\ManyToOne(targetEntity="BS\ResultBundle\Entity\MarketResult")
     * @ORM\JoinColumn(nullable=true)
     */
    private $marketResult;


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
     * Set outcome
     *
     * @param \BS\OfferBundle\Entity\Outcome $outcome
     *
     * @return Bet
     */
    public function setOutcome(\BS\OfferBundle\Entity\Outcome $outcome)
    {
        $this->outcome = $outcome;

        return $this;
    }

    /**
     * Get outcome
     *
     * @return \BS\OfferBundle\Entity\Outcome
     */
    public function getOutcome()
    {
        return $this->outcome;
    }

    /**
     * Set marketResult
     *
     * @param \BS\ResultBundle\Entity\MarketResult $marketResult
     *
     * @return Bet
     */
    public function setMarketResult(\BS\ResultBundle\Entity\MarketResult $marketResult = null)
    {
        $this->marketResult = $marketResult;

        return $this;
    }

    /**
     * Get marketResult
     *
     * @return \BS\ResultBundle\Entity\MarketResult
     */
    public function getMarketResult()
    {
        return $this->marketResult;
    }

    /**
     * Set strategy
     *
     * @param \BS\ResultBundle\Entity\Strategy $strategy
     *
     * @return Bet
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
}
