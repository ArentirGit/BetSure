<?php

namespace BS\ResultBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use BS\ResultBundle\Entity\Result;
use BS\ResultBundle\Entity\MarketResult;
use BS\ResultBundle\Repository;

class ResultController extends Controller
{

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
     * Permet de mettre a jour la table result lorsque l'offre est expiré et passe alors à la fois dans la table offre et result
     * Cet evenement va permettre la mise à jour des bets, et entrainer les supression en cascade jusqu'a la supression de l'offre
     */
    public function offerToResultAction()
    {
        $repositoryOffer = $this->getDoctrine()->getManager()->getRepository('BSOfferBundle:Offer');
        $offerParameterList = $repositoryOffer->getEventId();

        $repositoryResult = $this->getDoctrine()->getManager()->getRepository('BSResultBundle:Result');
        $em = $this->getDoctrine()->getManager();
        foreach($offerParameterList as $offerParameter)
        {
            $Result = $repositoryResult->getResultByEventId($offerParameter['eventId']);
            if(!empty($Result))
            {
                $Result[0]->setMarketId($offerParameter['marketId']);
                $Result[0]->setSportId($offerParameter['sportId']);
                $em->persist($Result[0]);
                $em->flush();
            }
        }
        return new Response('Hello World');
    }
}