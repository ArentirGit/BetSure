<?php
/**
 * Created by PhpStorm.
 * User: Björn
 * Date: 21/01/2016
 * Time: 09:22
 */

namespace BS\OfferBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;


class OutcomeRepository extends EntityRepository
{
    /*public function getDuplicateEntry()
    {
        $query = $this->_em->createQuery('SELECT o1 FROM BSResultBundle:MarketResult o1, BSResultBundle:MarketResult o2 WHERE o1.id > o2.id AND o1.offer_id = o2.offer_id AND o1.labelOutcome = o2.labelOutcome AND o1.cote = o2.cote');

        return $query->getResult();
    }

    public function getOutcomeToDelete($offerId)
    {
        $query = $this->_em->createQuery('SELECT o FROM BSOfferBundle:Outcome o WHERE o.offer = :offerId');
        $query->setParameter('offerId',$offerId);
        return $query->getResult();
    }*/

    public function getOutcomeByLabel($labelOutcome)
    {
        $query = $this->_em->createQuery('SELECT o FROM BSOfferBundle:Outcome o WHERE o.labelOutcome = :labelOutcome');
        $query->setParameter('labelOutcome', $labelOutcome);
        return $query->getResult();
    }

    public function verifyDuplicate($outcome, $offer)
    {
        $query = $this->_em->createQuery('SELECT o FROM BSOfferBundle:Outcome o WHERE o.indexOffer = :indexOffer AND o.eventId = :eventId AND o.labelOutcome = :labelOutcome');
        $query->setParameters(array('eventId' => $offer->eventId, 'indexOffer' => $offer->index, 'labelOutcome' => $outcome->label));
        return $query->getResult();
    }
}