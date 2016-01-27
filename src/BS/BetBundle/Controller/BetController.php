<?php

namespace BS\BetBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use BS\BetBundle\Entity\Bet;



class BetController extends Controller
{
    public function homeAction()
    {
        $outcomeRepository = $this->getDoctrine()->getManager()->getRepository('BSOfferBundle:Outcome');
        $homeOutcomeList = $outcomeRepository->getOutcomeByLabel('1');
        $repositoryBet = $this->getDoctrine()->getManager()->getRepository('BSBetBundle:Bet');
        foreach($homeOutcomeList as $homeOutcome)
        {
            $bet = new Bet();
            $bet->setOutcome($homeOutcome);
            $duplicateBet = $repositoryBet->verifyDuplicate($homeOutcome);
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
        $betRepository = $this->getDoctrine()->getManager()->getRepository('BSBetBundle:Bet');
        $marketResultRepository = $this->getDoctrine()->getManager()->getRepository('BSResultBundle:MarketResult');
        $betList = $betRepository->findAll();
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