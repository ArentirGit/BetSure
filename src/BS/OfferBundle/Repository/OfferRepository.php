<?php
/**
 * Created by PhpStorm.
 * User: Bj�rn
 * Date: 21/01/2016
 * Time: 09:22
 */

namespace BS\OfferBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;


class OfferRepository extends EntityRepository
{
    public function getEventId()
    {
        $query = $this->_em->createQuery('SELECT o.eventId, o.marketId, o.sportId FROM BSOfferBundle:Offer o');
        return $query->getResult();
    }

    public function getOfferByEventId($eventId)
    {
        $query = $this->_em->createQuery('SELECT o1 FROM BSOfferBundle:Offer o1, BSOfferBundle:Offer o2 WHERE o1.id > o2.id AND o1.indexOffer = o2.indexOffer AND o1.eventId = o2.eventId AND o1.eventId = :eventId');
        $query->setParameter('eventId',$eventId);

        return $query->getResult();
    }

    public function getOfferByCompetitionId($competitionId){
        $query = $this->_em->createQuery('SELECT o FROM BSOfferBundle:Offer o WHERE o.competitionId = :competitionId');
        $query->setParameter('competitionId', $competitionId);

        return $query->getResult();
    }

    public function verifyDuplicate($offer)
    {
        $query = $this->_em->createQuery('SELECT o FROM BSOfferBundle:Offer o WHERE o.eventId = :eventId AND o.indexOffer = :indexOffer');
        $query->setParameters(array('eventId' => $offer->eventId, 'indexOffer' => $offer->index));

        return $query->getResult();
    }

    public function getLabelOffer()
    {
        $query = $this->_em->createQuery('SELECT o.labelOffer FROM BSOfferBundle:Offer o');
        return $query->getResult();
    }


}