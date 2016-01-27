<?php

namespace BS\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class MainController extends Controller
{
    public function mainAction()
    {
        ini_set('max_execution_time', 600); //300 seconds = 5 minutes
        $this->forward('BSOfferBundle:Offer:get');
        $this->forward('BSResultBundle:Result:get');
        $this->forward('BSBetBundle:Bet:home');
        $this->forward('BSResultBundle:Result:offerToResult');
        $this->forward('BSRBetBundle:Bet:update');

        return new Response("Hello World");
    }
}