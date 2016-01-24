<?php
/**
 * Created by PhpStorm.
 * User: Björn
 * Date: 24/01/2016
 * Time: 18:56
 */

namespace BS\ResultBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;

class ResultRepository extends EntityRepository
{
    public function getResultByEventId($eventId)
    {
        $query = $this->_em->createQuery('SELECT r FROM BSResultBundle:Result r WHERE r.eventId = :eventId');
        $query->setParameter('eventId',$eventId);

        return $query->getResult();
    }
}