<?php

namespace BS\OfferBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Outcome
 *
 * @ORM\Table(name="outcome")
 * @ORM\Entity(repositoryClass="BS\OfferBundle\Repository\OutcomeRepository")
 */
class Outcome
{

    /**
     * @ORM\ManyToOne(targetEntity="BS\OfferBundle\Entity\Offer", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $offer;

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
     * @ORM\Column(name="eventId", type="string", length=255)
     */
    private $eventId;

    /**
     * @var string
     *
     * @ORM\Column(name="indexOffer", type="string", length=255)
     */
    private $indexOffer;

    /**
     * @var string
     *
     * @ORM\Column(name="labelOutcome", type="string", length=255)
     */
    private $labelOutcome;

    /**
     * @var string
     *
     * @ORM\Column(name="cote", type="string", length=255)
     */
    private $cote;


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
     * Set labelOutcome
     *
     * @param string $labelOutcome
     *
     * @return Outcome
     */
    public function setLabelOutcome($labelOutcome)
    {
        $this->labelOutcome = $labelOutcome;

        return $this;
    }

    /**
     * Get labelOutcome
     *
     * @return string
     */
    public function getLabelOutcome()
    {
        return $this->labelOutcome;
    }

    /**
     * Set cote
     *
     * @param string $cote
     *
     * @return Outcome
     */
    public function setCote($cote)
    {
        $this->cote = $cote;

        return $this;
    }

    /**
     * Get cote
     *
     * @return string
     */
    public function getCote()
    {
        return $this->cote;
    }

    /**
     * Set offer
     *
     * @param \BS\OfferBundle\Entity\Offer $offer
     *
     * @return Outcome
     */
    public function setOffer(\BS\OfferBundle\Entity\Offer $offer)
    {
        $this->offer = $offer;

        return $this;
    }

    /**
     * Get offer
     *
     * @return \BS\OfferBundle\Entity\Offer
     */
    public function getOffer()
    {
        return $this->offer;
    }

    /**
     * Set eventId
     *
     * @param string $eventId
     *
     * @return Outcome
     */
    public function setEventId($eventId)
    {
        $this->eventId = $eventId;

        return $this;
    }

    /**
     * Get eventId
     *
     * @return string
     */
    public function getEventId()
    {
        return $this->eventId;
    }

    /**
     * Set indexOffer
     *
     * @param string $indexOffer
     *
     * @return Outcome
     */
    public function setIndexOffer($indexOffer)
    {
        $this->indexOffer = $indexOffer;

        return $this;
    }

    /**
     * Get indexOffer
     *
     * @return string
     */
    public function getIndexOffer()
    {
        return $this->indexOffer;
    }
}
