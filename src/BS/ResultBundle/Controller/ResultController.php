<?php

namespace BS\ResultBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use BS\ResultBundle\Entity\Result;
use BS\ResultBundle\Entity\MarketResult;
use BS\ResultBundle\Entity\Strategy;
use BS\ResultBundle\Repository;

class ResultController extends Controller
{

    public function resultStrategyAction($strategyLabel)
    {
        ini_set('max_execution_time', 18000);
        ini_set('memory_limit', '-1');
        $strategyRepository = $this->getDoctrine()->getManager()->getRepository('BSResultBundle:Strategy');
        $strategy = $strategyRepository->getByLabel($strategyLabel)[0];
        $strategy->setMoneyBet(0.0);
        $strategy->setMoneyEarned(0.0);
        $betRepository = $this->getDoctrine()->getManager()->getRepository('BSBetBundle:Bet');
        $betList = $betRepository->getAllByStrategy($strategy);
        $moneyBet = 0.0;
        $moneyEarned = 0.0;
        $sportArray = array("100" => array("defeat" => 0, "played" => 0), "601600" => array("defeat" => 0, "played" => 0), "600" => array("defeat" => 0, "played" => 0), "964500" => array("defeat" => 0, "played" => 0), "1200" => array("defeat" => 0, "played" => 0), "1100" => array("defeat" => 0, "played" => 0), "2100"=> array("defeat" => 0, "played" => 0), "700" => array("defeat" => 0, "played" => 0));
        if(!empty($betList)) {
            foreach ($betList as $bet) {
                if (!is_null($bet->getMarketResult())) {
                    $outcome = $bet->getOutcome();
                    $marketResult = $bet->getMarketResult();
                    $sportId = $bet->getMarketResult()->getResult()->getSportId();
                    $sportArray[$sportId]['played'] = $sportArray[$sportId]['played'] + 1.0;
                    if ($outcome->getLabelOutcome() == $marketResult->getResultat()) {
                        $moneyBet = $moneyBet + 1.0;
                        $cote = "";
                        $cote = $cote . $outcome->getCote()[0];
                        $cote = $cote . ".";
                        $cote = $cote . $outcome->getCote()[2];
                        $cote = $cote . $outcome->getCote()[3];
                        $cote = floatval($cote);
                        $moneyEarned = $moneyEarned + $cote /*$outcome->getCote()*/;
                    } else {
                        $sportArray[$sportId]['defeat'] = $sportArray[$sportId]['defeat'] + 1.0;
                        $moneyBet = $moneyBet + 1.0;
                    }
                }
            }
            $badRate = 0.0;
            $badSportId = null;
            foreach ($sportArray as $sportId => $stats) {
                if($stats['played'] != 0) {
                    $rate = (float)$stats['defeat'] / $stats['played'];
                    if ($rate > $badRate) {
                        $badRate = $rate;
                        $badSportId = $sportId;
                    }
                }
            }

            $strategy->setBadSportId($badSportId);
            $strategy->setMoneyBet($strategy->getMoneyBet() + $moneyBet);
            $strategy->setMoneyEarned($strategy->getMoneyEarned() + $moneyEarned);
            $strategy->setReturnOnInvestment($strategy->getMoneyEarned() / $strategy->getMoneyBet());

            $em = $this->getDoctrine()->getManager();
            $em->persist($strategy);
            $em->flush();

            var_dump($strategy->getMoneyEarned() / $strategy->getMoneyBet());
            var_dump($badRate);
            echo "<br>";
        }
        return new Response("Hello World");
    }

    public function createStrategyAction($strategyLabel)
    {
        ini_set('max_execution_time', 18000);
        $strategy = new Strategy();
        $strategy->setLabelStrategy($strategyLabel);
        $strategy->setReturnOnInvestment(0.0);
        $strategy->setMoneyBet(0.0);
        $strategy->setMoneyEarned(0.0);
        $em = $this->getDoctrine()->getManager();
        $em->persist($strategy);
        $em->flush();

        return new Response("Hello World");
    }

    /*public function updateResultAction()
    {
        $marketResultRepository = $this->getDoctrine()->getManager()->getRepository('BSResultBundle:MarketResult');
        $marketResultList = $marketResultRepository->findAll();
        foreach($marketResultList as $marketResult)
        {
            if($marketResult->getResultat() == "1")
            {
                $marketResult->setResultat("Domicile");
                $em = $this->getDoctrine()->getManager();
                $em->persist($marketResult);
                $em->flush();
            }
            elseif($marketResult->getResultat() == "3")
            {
                $marketResult->setResultat("Exterieur");
                $em = $this->getDoctrine()->getManager();
                $em->persist($marketResult);
                $em->flush();
            }
        }

        return new Response("Hello World");
    }*/

    /*
     * Récupération des résultats des paris s'étant fini la veille du jour courant
     * Impossibilité d'avoir de doublon
     */
    public function getAction()
    {
        ini_set('max_execution_time', 18000);
        //$apiContent = file_get_contents("https://www.parionssport.fr/api/1n2/resultats?date=".strftime("%Y%m%d", mktime(0, 0, 0, date('m'), date('d')-1, date('y'))));
        $apiContent = file_get_contents("https://www.parionssport.fr/api/1n2/resultats?date=20160204");
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
                if(strlen(strval($marketRes->index)) == 1)
                {
                    $indexMarketResult = "00".strval($marketRes->index);
                }
                elseif(strlen(strval($marketRes->index)) == 2)
                {
                    $indexMarketResult = "0".strval($marketRes->index);
                }
                else
                {
                    $indexMarketResult = strval($marketRes->index);
                }
                $localMarketRes->setIndexMarketResult($indexMarketResult);
                $localMarketRes->setMarketType($marketRes->marketType);
                if($marketRes->resultat == "1")
                {
                    $localMarketRes->setResultat("Domicile");
                }
                elseif($marketRes->resultat == "3")
                {
                    $localMarketRes->setResultat("Exterieur");
                }
                else {
                    $localMarketRes->setResultat("N");
                }
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
        ini_set('max_execution_time', 18000);
        $repositoryOffer = $this->getDoctrine()->getManager()->getRepository('BSOfferBundle:Offer');
        $offerParameterList = $repositoryOffer->getEventId();

        $repositoryResult = $this->getDoctrine()->getManager()->getRepository('BSResultBundle:Result');
        $em = $this->getDoctrine()->getManager();
        if (!empty($offerParameterList)) {
        foreach ($offerParameterList as $offerParameter) {
            $Result = $repositoryResult->getResultByEventId($offerParameter['eventId']);
            if (!empty($Result)) {
                $Result[0]->setMarketId($offerParameter['marketId']);
                $Result[0]->setSportId($offerParameter['sportId']);
                $em->persist($Result[0]);
                $em->flush();
            }
        }
    }
        return new Response('Hello World');
    }

    public function updateResultAction(){

    }
}