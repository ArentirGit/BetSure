<?php

namespace BS\ResultBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use BS\ResultBundle\Entity\Result;
use BS\ResultBundle\Entity\MarketResult;

class ResultController extends Controller
{
    public function getAction()
    {
        $apiContent = file_get_contents("https://www.parionssport.fr/api/1n2/resultats?date=20160118");
        $resultInformations = json_decode($apiContent);
        foreach($resultInformations as $result)
        {
            $localResult = new Result();
            $localResult->setId($result->eventId);
            $localResult->setEnd($result->end);
            $localResult->setEventLabel($result->label);
            $localResult->setCompetition($result->competition);
            $localResult->setCompetitionID($result->competitionID);
            foreach($result->marketRes as $marketRes)
            {
                $localMarketRes = new MarketResult();
                $localMarketRes->setId($marketRes->index);
                $localMarketRes->setMarketType($marketRes->marketType);
                $localMarketRes->setResultat($marketRes->resultat);
                $localMarketRes->setResult($localResult);
                $em = $this->getDoctrine()->getManager();
                $em->persist($localMarketRes);
                $em->flush();
            }
            $em = $this->getDoctrine()->getManager();
            $em->persist($localResult);
            $em->flush();
        }
        return new Response("Hello World");
    }
}