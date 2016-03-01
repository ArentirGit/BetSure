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

    public function getOutcomeByLabelAndOffer($labelOutcome, $offer)
    {
        $query = $this->_em->createQuery('SELECT o FROM BSOfferBundle:Outcome o WHERE o.labelOutcome = :labelOutcome AND o.offer = :offer');
        $query->setParameters(array('labelOutcome' => $labelOutcome, 'offer' => $offer));
        return $query->getResult();
    }

    public function getOutcomeByLabel($labelOutcome)
    {
        $query = $this->_em->createQuery('SELECT o FROM BSOfferBundle:Outcome o WHERE o.labelOutcome = :labelOutcome');
        $query->setParameter('labelOutcome', $labelOutcome);
        return $query->getResult();
    }
    public function getOutcomeByLabelAndMinimumCote($labelOutcome, $coteOutcome)
    {
        $query = $this->_em->createQuery('SELECT o FROM BSOfferBundle:Outcome o WHERE o.labelOutcome = :labelOutcome AND o.cote >= :cote');
        $query->setParameters(array('labelOutcome' => $labelOutcome, 'cote' => $coteOutcome));
        return $query->getResult();
    }

    public function getOutcomeByLabelAndMinimumCoteAndWBS($labelOutcome, $coteOutcome, $sportId)
    {
        $query = $this->_em->createQuery('SELECT ou, o FROM BSOfferBundle:Outcome ou JOIN ou.offer o WHERE ou.labelOutcome = :labelOutcome AND ou.cote >= :cote AND o.sportId IS NOT :sportId');
        $query->setParameters(array('labelOutcome' => $labelOutcome, 'cote' => $coteOutcome, 'sportId' => $sportId));
        return $query->getResult();
    }

    public function getOutcomeByLabelAndMaximumCote($labelOutcome, $coteOutcome)
    {
        $query = $this->_em->createQuery('SELECT o FROM BSOfferBundle:Outcome o WHERE o.labelOutcome = :labelOutcome AND o.cote <= :cote');
        $query->setParameters(array('labelOutcome' => $labelOutcome, 'cote' => $coteOutcome));
        return $query->getResult();
    }

    public function getOutcomeByLabelAndBetweenCote($labelOutcome, $coteLowOutcome, $coteUpOutcome)
    {
        $query = $this->_em->createQuery('SELECT o FROM BSOfferBundle:Outcome o WHERE o.labelOutcome = :labelOutcome AND o.cote <= :coteUp AND o.cote >= :coteLow');
        $query->setParameters(array('labelOutcome' => $labelOutcome, 'coteUp' => $coteUpOutcome, 'coteLow' => $coteLowOutcome));
        return $query->getResult();
    }


    public function verifyDuplicate($label, $offer)
    {
        $query = $this->_em->createQuery('SELECT o FROM BSOfferBundle:Outcome o WHERE o.indexOffer = :indexOffer AND o.eventId = :eventId AND o.labelOutcome = :labelOutcome');
        $query->setParameters(array('eventId' => $offer->eventId, 'indexOffer' => $offer->index, 'labelOutcome' => $label));
        return $query->getResult();
    }

    public function getOutcomeByLabelAndBetweenCoteAndWBS($labelOutcome, $coteLowOutcome, $coteUpOutcome, $sportId)
    {
        $query = $this->_em->createQuery('SELECT ou, o FROM BSOfferBundle:Outcome ou JOIN ou.offer o WHERE ou.labelOutcome = :labelOutcome AND ou.cote <= :coteUp AND ou.cote >= :coteLow AND o.sportId <> :sportId');
        $query->setParameters(array('labelOutcome' => $labelOutcome, 'coteUp' => $coteUpOutcome, 'coteLow' => $coteLowOutcome, 'sportId' => $sportId));
        return $query->getResult();
    }
}