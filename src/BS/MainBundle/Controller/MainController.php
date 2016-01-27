<?php

namespace BS\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class MainController extends Controller
{
    public function mainAction()
    {
        ini_set('max_execution_time', 600); //300 seconds = 5 minutes
        ini_set('memory_limit', '-1');
        $this->forward('BSOfferBundle:Offer:get');
        $this->forward('BSResultBundle:Result:get');
        $this->forward('BSBetBundle:Bet:home');
        $this->forward('BSResultBundle:Result:offerToResult');
        $this->forward('BSBetBundle:Bet:update');

        return new Response("Hello World");
    }
}