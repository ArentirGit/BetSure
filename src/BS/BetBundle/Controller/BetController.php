<?php

namespace BS\BetBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use BS\BetBundle\Entity\Bet;



class BetController extends Controller
{
    public function getAction($labelStrategy)
    {
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