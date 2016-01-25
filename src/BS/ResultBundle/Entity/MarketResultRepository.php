<?php
/**
 * Created by PhpStorm.
 * User: Damien
 * Date: 25/01/2016
 * Time: 10:49
 */

namespace BS\ResultBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;

class MarketResultRepository extends EntityRepository
{
    public function getDuplicateEntry()
    {
        $query = $this->_em->createQuery('SELECT r1 FROM BSResultBundle:MarketResult r1, BSResultBundle:MarketResult r2 WHERE r1.id > r2.id AND r1.result_id = r2.result_id AND r1.indexMarketResult = r2.indexMarketResult AND r1.marketType = r2.marketType AND r1.resultat = r2.resultat');

        return $query->getResult();
    }

    public function getMarketResultToDelete($resultId)
    {
        $query = $this->_em->createQuery('SELECT m FROM BSResultBundle:MarketResult m WHERE m.result = :resultId');
        $query->setParameter('resultId',$resultId);
        return $query->getResult();
    }
}