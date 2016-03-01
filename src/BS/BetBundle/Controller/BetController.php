<?php

namespace BS\BetBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use BS\BetBundle\Entity\Bet;
use BS\TeamBundle\Entity\Team;
use BS\OfferBundle\Entity\Offer;
use BS\OfferBundle\Entity\Outcome;
use BS\ResultBundle\Entity\Strategy;



class BetController extends Controller
{
    public function secondHalfRankAction()
    {
        ini_set('max_execution_time', 18000);
        ini_set('memory_limit', '-1');
        $betRepository = $this->getDoctrine()->getManager()->getRepository('BSBetBundle:Bet');
        $teamRepository = $this->getDoctrine()->getManager()->getRepository('BSTeamBundle:Team');
        $offerRepository = $this->getDoctrine()->getManager()->getRepository('BSOfferBundle:Offer');
        $outcomeRepository = $this->getDoctrine()->getManager()->getRepository('BSOfferBundle:Outcome');
        $strategyRepository = $this->getDoctrine()->getManager()->getRepository('BSResultBundle:Strategy');

        $competitionList = $teamRepository->getTeamGroupByCompetition();
        $strategy = $strategyRepository->getByLabel("SecondHalfRank")[0];
        foreach($competitionList as $competition) {
            $offerList = $offerRepository->getOfferByCompetitionId($competition['competitionId']);
            $ranking = $teamRepository->getRanking($competition['competitionId']);
            $split = floatval(sizeof($ranking) / 2.00);
            foreach ($offerList as $offer) {
                if (($offer->getHomeTeamId() != null) && ($offer->getOutsideTeamId() != null)) {
                    $homeTeam = $teamRepository->find($offer->getHomeTeamId());
                    $outsideTeam = $teamRepository->find($offer->getOutsideTeamId());
                    if ($homeTeam->getRank() > $split) {
                        if ($outsideTeam->getRank() < $split) {
                            $outcome = $outcomeRepository->getOutcomeByLabelAndOffer('Domicile', $offer);
                            if (!empty($outcome)) {
                                $outcome = $outcome[0];
                                $bet = new Bet();
                                $bet->setOutcome($outcome);
                                $bet->setStrategy($strategy);
                                $duplicateBet = $betRepository->verifyDuplicate($outcome, $strategy);
                                if (empty($duplicateBet)) {
                                    $em = $this->getDoctrine()->getManager();
                                    $em->persist($bet);
                                    $em->flush();
                                    var_dump($offer, sizeof($ranking), $split, $homeTeam->getRank(), $outsideTeam->getRank());
                                }
                            }
                        }
                    } elseif ($homeTeam->getRank() < $split) {
                        if ($outsideTeam->getRank() > $split) {
                            $outcome = $outcomeRepository->getOutcomeByLabelAndOffer('Exterieur', $offer);
                            if (!empty($outcome)) {
                                $outcome = $outcome[0];
                                $bet = new Bet();
                                $bet->setOutcome($outcome);
                                $bet->setStrategy($strategy);
                                $duplicateBet = $betRepository->verifyDuplicate($outcome, $strategy);
                                if (empty($duplicateBet)) {
                                    $em = $this->getDoctrine()->getManager();
                                    $em->persist($bet);
                                    $em->flush();
                                    var_dump($offer, sizeof($ranking), $split, $homeTeam->getRank(), $outsideTeam->getRank());
                                }
                            }
                        }
                    }
                }
            }
        }

        return new Response("Hello World");
    }

    public function getBetweenPriceWBSAction($labelStrategy, $outcomeLowCote, $outcomeUpCote)
    {
        ini_set('max_execution_time', 18000);
        if (preg_match('/Home/', $labelStrategy)) {
            $outcomeLabel = 'Domicile';
        } else {
            $outcomeLabel = 'Exterieur';
        }
        $strategyRepository = $this->getDoctrine()->getManager()->getRepository('BSResultBundle:Strategy');
        $strategy = $strategyRepository->getByLabel($labelStrategy)[0];
        var_dump($strategy);
        $badSportId = $strategy->getBadSportId();
        var_dump($badSportId);
        $strategy = $strategyRepository->getByLabel($labelStrategy."WBS")[0];
        var_dump($strategy);
        $outcomeRepository = $this->getDoctrine()->getManager()->getRepository('BSOfferBundle:Outcome');
        var_dump($outcomeLabel, $outcomeLowCote, $outcomeUpCote, $badSportId);
        $outcomeList = $outcomeRepository->getOutcomeByLabelAndBetweenCoteAndWBS($outcomeLabel, $outcomeLowCote, $outcomeUpCote, $badSportId);
        var_dump($outcomeList);
        $repositoryBet = $this->getDoctrine()->getManager()->getRepository('BSBetBundle:Bet');
        if(!empty($outcomeList)) {
            foreach ($outcomeList as $outcome) {
                $bet = new Bet();
                $bet->setOutcome($outcome);
                $bet->setStrategy($strategy);
                $duplicateBet = $repositoryBet->verifyDuplicate($outcome, $strategy);
                if (empty($duplicateBet)) {
                    $em = $this->getDoctrine()->getManager();
                    $em->persist($bet);
                    $em->flush();
                }
            }
        }
        return new Response("Hello World");
    }

    public function getBetweenPriceAction($labelStrategy, $outcomeLowCote, $outcomeUpCote)
    {
        ini_set('max_execution_time', 18000);
        if (preg_match('/Home/', $labelStrategy)) {
            $outcomeLabel = 'Domicile';
        } else {
            $outcomeLabel = 'Exterieur';
        }
        $strategyRepository = $this->getDoctrine()->getManager()->getRepository('BSResultBundle:Strategy');
        $strategy = $strategyRepository->getByLabel($labelStrategy)[0];
        $outcomeRepository = $this->getDoctrine()->getManager()->getRepository('BSOfferBundle:Outcome');
        $outcomeList = $outcomeRepository->getOutcomeByLabelAndBetweenCote($outcomeLabel, $outcomeLowCote, $outcomeUpCote);
        $repositoryBet = $this->getDoctrine()->getManager()->getRepository('BSBetBundle:Bet');
        if(!empty($outcomeList)) {
            foreach ($outcomeList as $outcome) {
                $bet = new Bet();
                $bet->setOutcome($outcome);
                $bet->setStrategy($strategy);
                $duplicateBet = $repositoryBet->verifyDuplicate($outcome, $strategy);
                if (empty($duplicateBet)) {
                    $em = $this->getDoctrine()->getManager();
                    $em->persist($bet);
                    $em->flush();
                }
            }
        }
        return new Response("Hello World");
    }

    public function getMinimumPriceActionWBS($labelStrategy, $outcomeCote)
    {
        ini_set('max_execution_time', 18000);
        if (preg_match('/Home/', $labelStrategy)) {
            $outcomeLabel = 'Domicile';
        } else {
            $outcomeLabel = 'Exterieur';
        }
        $strategyRepository = $this->getDoctrine()->getManager()->getRepository('BSResultBundle:Strategy');
        $strategy = $strategyRepository->getByLabel($labelStrategy)[0];
        $badSportId = $strategy->getBadSportId();
        $strategy = $strategyRepository->getByLabel($labelStrategy."WBS")[0];
        $outcomeRepository = $this->getDoctrine()->getManager()->getRepository('BSOfferBundle:Outcome');
        $outcomeList = $outcomeRepository->getOutcomeByLabelAndMinimumCoteAndWBS($outcomeLabel, $outcomeCote, $badSportId);
        $repositoryBet = $this->getDoctrine()->getManager()->getRepository('BSBetBundle:Bet');
        if(!empty($outcomeList)) {
            foreach ($outcomeList as $outcome) {
                $bet = new Bet();
                $bet->setOutcome($outcome);
                $bet->setStrategy($strategy);
                $duplicateBet = $repositoryBet->verifyDuplicate($outcome, $strategy);
                if (empty($duplicateBet)) {
                    $em = $this->getDoctrine()->getManager();
                    $em->persist($bet);
                    $em->flush();
                }
            }
        }

        return new Response("Hello World");
    }

    public function getMinimumPriceAction($labelStrategy, $outcomeCote)
    {
        ini_set('max_execution_time', 18000);
        if (preg_match('/Home/', $labelStrategy)) {
            $outcomeLabel = 'Domicile';
        } else {
            $outcomeLabel = 'Exterieur';
        }
        $strategyRepository = $this->getDoctrine()->getManager()->getRepository('BSResultBundle:Strategy');
        $strategy = $strategyRepository->getByLabel($labelStrategy)[0];
        $outcomeRepository = $this->getDoctrine()->getManager()->getRepository('BSOfferBundle:Outcome');
        $outcomeList = $outcomeRepository->getOutcomeByLabelAndMinimumCote($outcomeLabel, $outcomeCote);
        $repositoryBet = $this->getDoctrine()->getManager()->getRepository('BSBetBundle:Bet');
        if(!empty($outcomeList)) {
            foreach ($outcomeList as $outcome) {
                $bet = new Bet();
                $bet->setOutcome($outcome);
                $bet->setStrategy($strategy);
                $duplicateBet = $repositoryBet->verifyDuplicate($outcome, $strategy);
                if (empty($duplicateBet)) {
                    $em = $this->getDoctrine()->getManager();
                    $em->persist($bet);
                    $em->flush();
                }
            }
        }

        return new Response("Hello World");
    }

    public function getMaximumPriceAction($labelStrategy, $outcomeCote)
    {
        ini_set('max_execution_time', 18000);
        if (preg_match('/Home/', $labelStrategy)) {
            $outcomeLabel = 'Domicile';
        } else {
            $outcomeLabel = 'Exterieur';
        }
        $strategyRepository = $this->getDoctrine()->getManager()->getRepository('BSResultBundle:Strategy');
        $strategy = $strategyRepository->getByLabel($labelStrategy)[0];
        $outcomeRepository = $this->getDoctrine()->getManager()->getRepository('BSOfferBundle:Outcome');
        $outcomeList = $outcomeRepository->getOutcomeByLabelAndMaximumCote($outcomeLabel, $outcomeCote);
        $repositoryBet = $this->getDoctrine()->getManager()->getRepository('BSBetBundle:Bet');
        foreach ($outcomeList as $outcome) {
            $bet = new Bet();
            $bet->setOutcome($outcome);
            $bet->setStrategy($strategy);
            $duplicateBet = $repositoryBet->verifyDuplicate($outcome, $strategy);
            if (empty($duplicateBet)) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($bet);
                $em->flush();
            }
        }

        return new Response("Hello World");
    }


    public function getAction($labelStrategy)
    {
        ini_set('max_execution_time', 18000);
        if($labelStrategy == 'Home')
        {
            $outcomeLabel = 'Domicile';
        }
        elseif($labelStrategy == 'Nul')
        {
            $outcomeLabel = 'N';
        }
        else
        {
            $outcomeLabel = 'Exterieur';
        }
        $strategyRepository = $this->getDoctrine()->getManager()->getRepository('BSResultBundle:Strategy');
        $strategy = $strategyRepository->getByLabel($labelStrategy)[0];
        $outcomeRepository = $this->getDoctrine()->getManager()->getRepository('BSOfferBundle:Outcome');
        $outcomeList = $outcomeRepository->getOutcomeByLabel($outcomeLabel);
        $repositoryBet = $this->getDoctrine()->getManager()->getRepository('BSBetBundle:Bet');
        foreach($outcomeList as $outcome)
        {
            $bet = new Bet();
            $bet->setOutcome($outcome);
            $bet->setStrategy($strategy);
            $duplicateBet = $repositoryBet->verifyDuplicate($outcome, $strategy);
            if(empty($duplicateBet))
            {
                $em = $this->getDoctrine()->getManager();
                $em->persist($bet);
                $em->flush();
            }
        }

        return new Response("Hello World");
    }

    public function updateAction()
    {
        ini_set('max_execution_time', 18000);
        $betRepository = $this->getDoctrine()->getManager()->getRepository('BSBetBundle:Bet');
        $marketResultRepository = $this->getDoctrine()->getManager()->getRepository('BSResultBundle:MarketResult');
        $betList = $betRepository->getAllForUpdate();
        if(!empty($betList)) {
            foreach ($betList as $bet) {
                $marketResultList = $marketResultRepository->getMarketResultByEventId($bet);
                if (!empty($marketResultList)) {
                    $bet->setMarketResult($marketResultList[0]);
                    $em = $this->getDoctrine()->getManager();
                    $em->persist($bet);
                    $em->flush();
                }
            }
        }
        return new Response("Hello World");
    }

    /*public function getToPlayAction()
    {
        $strategyRepository = $this->getDoctrine()->getManager()->getRepository('BSResultBundle:Strategy');
        $strategyList = $strategyRepository->getPositive();
        $betRepository = $this->getDoctrine()->getManager()->getRepository('BSBetBundle:Bet');
        $betToPlayList = array();
        foreach($strategyList as $strategy) {
            $betList = $betRepository->getToPlay($strategy);
            foreach ($betList as $bet) {
                array_push($betToPlayList, $bet);
            }
        }
            $message = \Swift_Message::newInstance()
                ->setSubject('Paris � jouer ' . strftime("%Y/%m/%d", mktime(0, 0, 0, date('m'), date('d'), date('y'))))
                ->setFrom('arentir.contact@gmail.com')
                ->setTo('arentir.contact@gmail.com')
                //->setTo('bjorn.dagens@gmail.com')
                ->setBody($this->renderView('BSBetBundle:Bet:offerToPlay.html.twig', array('betList' => $betToPlayList)))
                ->setContentType('text/html');

            $this->get('mailer')->send($message);
        //$this->container->setParameter('database_name', 'betsure');
        //var_dump($this->container->getParameter('database_name'));



        return new Response("Hello World");
    }*/
}