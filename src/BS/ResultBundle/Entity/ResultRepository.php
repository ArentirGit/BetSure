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

    public function getDuplicateEntry()
    {
        $query = $this->_em->createQuery('SELECT r1 FROM BSResultBundle:Result r1, BSResultBundle:Result r2 WHERE r1.id > r2.id AND r1.eventId = r2.eventId');

        return $query->getResult();
    }
}