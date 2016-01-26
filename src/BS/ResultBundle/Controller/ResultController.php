<?php

namespace BS\ResultBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use BS\ResultBundle\Entity\Result;
use BS\ResultBundle\Entity\MarketResult;

class ResultController extends Controller
{
    /*public function deleteDuplicateEntryAction()
    {
        $resultRepository = $this->getDoctrine()->getManager()->getRepository("BSResultBundle:Result");
        $duplicateResultList = $resultRepository->getDuplicateEntry();

        $marketRepository = $this->getDoctrine()->getManager()->getRepository("BSResultBundle:MarketResult");

        $em = $this->getDoctrine()->getManager();
        foreach($duplicateResultList as $duplicateResult)
        {
            $marketResultList = $marketRepository->getMarketResultToDelete($duplicateResult->getId());
            foreach($marketResultList as $marketResult)
            {
                $em->remove($marketResult);
                $em->flush();
            }
            $em->remove($duplicateResult);
            $em->flush();
        }

        return new Response("Hello World");
    }*/

    /*
     * Récupération des résultats des paris s'étant fini la veille du jour courant
     * Impossibilité d'avoir de doublon
     */
    public function getAction()
    {
        $apiContent = file_get_contents("https://www.parionssport.fr/api/1n2/resultats?date=".strftime("%Y%m%d", mktime(0, 0, 0, date('m'), date('d')-1, date('y'))));
        $resultInformations = json_decode($apiContent);
        $repositoryResult = $this->getDoctrine()->getManager()->getRepository('BSResultBundle:Result');
        $repositoryMarketResult = $this->getDoctrine()->getManager()->getRepository('BSResultBundle:MarketResult');
        foreach($resultInformations as $result)
        {
            $localResult = new Result();
            $localResult->setEventId($result->eventId);
            $localResult->setEnd($result->end);
            $localResult->setEventLabel($result->label);
            $localResult->setCompetition($result->competition);
            $localResult->setCompetitionID($result->competitionID);

            foreach($result->marketRes as $marketRes)
            {
                $localMarketRes = new MarketResult();
                $localMarketRes->setIndexMarketResult($marketRes->index);
                $localMarketRes->setMarketType($marketRes->marketType);
                $localMarketRes->setResultat($marketRes->resultat);
                $localMarketRes->setResult($localResult);
                $localMarketRes->setEventId($result->eventId);

                $duplicateMarketResult = $repositoryMarketResult->verifyDuplicate($marketRes, $result);
                if(empty($duplicateMarketResult))
                {
                    $em = $this->getDoctrine()->getManager();
                    $em->persist($localMarketRes);
                    $em->flush();
                }

            }
            $duplicateResult = $repositoryResult->verifyDuplicate($result);
            if(empty($duplicateResult)) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($localResult);
                $em->flush();
            }
        }
        return new Response("Hello World");
    }

    /*
    public function offerToResultAction()
    {
        $repositoryOffer = $this->getDoctrine()->getManager()->getRepository('BSOfferBundle:Offer');
        $offerParameterList = $repositoryOffer->getEventId();

        $repositoryOutcome = $this->getDoctrine()->getManager()->getRepository('BSOfferBundle:Outcome');

        $repositoryResult = $this->getDoctrine()->getManager()->getRepository('BSResultBundle:Result');
        $em = $this->getDoctrine()->getManager();
       // $tmp = $offerParameterList[0]['eventId'];
       // $offerParameterList[0]['eventId'] = 283757;
        foreach($offerParameterList as $offerParameter)
        {
            $Result = $repositoryResult->getResultByEventId($offerParameter['eventId']);
            if(!empty($Result))
            {
                $Result[0]->setMarketId($offerParameter['marketId']);
                $Result[0]->setSportId($offerParameter['sportId']);
                $em->persist($Result[0]);
                $em->flush();*/
                //$Offer = $repositoryOffer->getOfferByEventId($offerParameter['eventId']/*$tmp*/);
                /*foreach( $Offer as $of)
                {
                    $outcomeList = $repositoryOutcome->getOutcomeToDelete($of->getId());
                    foreach($outcomeList as $outcome)
                    {
                        $em->remove($outcome);
                        $em->flush();
                    }
                    $em->remove($of);
                    $em->flush();
                }*/
/*
            }
        }
        return new Response('Hello World');
    }*/
}