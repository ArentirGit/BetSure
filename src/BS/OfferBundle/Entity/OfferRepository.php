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


class OfferRepository extends EntityRepository
{
    public function getEventId()
    {
        $query = $this->_em->createQuery('SELECT o.eventId, o.marketId, o.sportId FROM BSOfferBundle:Offer o');
        return $query->getResult();
    }
}