<?php

namespace BS\BetBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use BS\BetBundle\Entity\Bet;



class BetController extends Controller
{
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
        foreach($betList as $bet)
        {
            $marketResultList = $marketResultRepository->getMarketResultByEventId($bet);
            if(!empty($marketResultList))
            {
                $bet->setMarketResult($marketResultList[0]);
                $em = $this->getDoctrine()->getManager();
                $em->persist($bet);
                $em->flush();
            }
        }

        return new Response("Hello World");
    }
}