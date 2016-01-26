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
        $em = $this->getDoctrine()->getManager();
        foreach($homeOutcomeList as $homeOutcome)
        {
            $bet = new Bet();
            $bet->setOutcome($homeOutcome);
            $em->persist($bet);
            $em->flush();
        }

        return new Response("Hello World");
    }
}