<?php
/**
 * Created by PhpStorm.
 * User: Björn
 * Date: 21/01/2016
 * Time: 09:22
 */

namespace BS\OfferBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;


class OutcomeRepository extends EntityRepository
{
    public function getDuplicateEntry()
    {
        $query = $this->_em->createQuery('SELECT r1 FROM BSResultBundle:MarketResult r1, BSResultBundle:MarketResult r2 WHERE r1.id > r2.id AND r1.offer_id = r2.offer_id AND r1.labelOutcome = r2.labelOutcome AND r1.cote = r2.cote');

        return $query->getResult();
    }

    public function getOutcomeToDelete($offerId)
    {
        $query = $this->_em->createQuery('SELECT o FROM BSOfferBundle:Outcome o WHERE o.offerId = :offerId');
        $query->setParameter('offerId',$offerId);
        return $query->getResult();
    }
}