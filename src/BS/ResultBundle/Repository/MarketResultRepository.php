<?php

namespace BS\ResultBundle\Repository;

//use BS\BetBundle\Entity\Bet;

/**
 * MarketResultRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class MarketResultRepository extends \Doctrine\ORM\EntityRepository
{

    public function verifyDuplicate($marketResult, $result)
    {
        $query = $this->_em->createQuery('SELECT m FROM BSResultBundle:MarketResult m WHERE m.indexMarketResult = :indexMarketResult AND m.eventId = :eventId');
        $query->setParameters(array('eventId' => $result->eventId, 'indexMarketResult' => $marketResult->index));
        return $query->getResult();
    }

    public function getMarketResultByEventId($bet)
    {
        $query = $this->_em->createQuery('SELECT m FROM BSResultBundle:MarketResult m WHERE m.eventId = :eventId AND m.indexMarketResult = :indexMarketResult');
        $query->setParameters(array('eventId' => $bet->getOutcome()->getEventId(), 'indexMarketResult' => $bet->getOutcome()->getIndexOffer()));
        return $query->getResult();
    }

    public function getVictory($resultId)
    {
        $query = $this->_em->createQuery('SELECT m FROM BSResultBundle:MarketResult m WHERE m.result  = :resultId AND m.marketType = :marketType');
        $query->setParameters(array('resultId' => $resultId, 'marketType' => '1/N/2'));
        return $query->getResult();
    }

    public function getResultJoinMarket()
    {
        $query = $this->_em->createQuery('SELECT mr, r FROM BSResultBundle:MarketResult mr JOIN mr.result r WHERE mr.marketType = :marketType');
        $query->setParameter('marketType','1/N/2');
        return $query->getResult();
    }

    public function countMarket()
    {
        $query = $this->_em->createQuery('SELECT COUNT(mr.id) AS nb FROM BSResultBundle:MarketResult mr WHERE mr.marketType = :marketType');
        $query->setParameter('marketType','1/N/2');
        return $query->getScalarResult();
    }

}
