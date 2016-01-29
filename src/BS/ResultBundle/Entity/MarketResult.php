<?php

namespace BS\ResultBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MarketResult
 *
 * @ORM\Table(name="market_result")
 * @ORM\Entity(repositoryClass="BS\ResultBundle\Repository\MarketResultRepository")
 */
class MarketResult
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
     * @ORM\ManyToOne(targetEntity="BS\ResultBundle\Entity\Result", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $result;

    /**
     * @var string
     *
     * @ORM\Column(name="indexMarketResult", type="string", length=255)
     */
    private $indexMarketResult;

    /**
     * @var int
     *
     * @ORM\Column(name="eventId", type="string", length=255)
     */
    private $eventId;

    /**
     * @var string
     *
     * @ORM\Column(name="marketType", type="string", length=255)
     */
    private $marketType;

    /**
     * @var string
     *
     * @ORM\Column(name="resultat", type="string", length=255)
     */
    private $resultat;


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
     * Set marketType
     *
     * @param string $marketType
     *
     * @return MarketResult
     */
    public function setMarketType($marketType)
    {
        $this->marketType = $marketType;

        return $this;
    }

    /**
     * Get marketType
     *
     * @return string
     */
    public function getMarketType()
    {
        return $this->marketType;
    }

    /**
     * Set resultat
     *
     * @param string $resultat
     *
     * @return MarketResult
     */
    public function setResultat($resultat)
    {
        $this->resultat = $resultat;

        return $this;
    }

    /**
     * Get resultat
     *
     * @return string
     */
    public function getResultat()
    {
        return $this->resultat;
    }

    /**
     * Set id
     *
     * @param int $id
     *
     * @return MarketResult
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Set result
     *
     * @param \BS\ResultBundle\Entity\Result $result
     *
     * @return MarketResult
     */
    public function setResult(\BS\ResultBundle\Entity\Result $result)
    {
        $this->result = $result;

        return $this;
    }

    /**
     * Get result
     *
     * @return \BS\ResultBundle\Entity\MarketResult
     */
    public function getResult()
    {
        return $this->result;
    }

    /**
     * Set indexMarketResult
     *
     * @param string $indexMarketResult
     *
     * @return MarkatResult
     */
    public function setIndexMarketResult($indexMarketResult)
    {
        $this->indexMarketResult = $indexMarketResult;

        return $this;
    }

    /**
     * Get indexMarketResult
     *
     * @return string
*/
    public function getIndexMarketResult()
    {
        return $this->indexMarketResult;
    }

    /**
     * Set eventId
     *
     * @param string $eventId
     *
     * @return MarketResult
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
}
