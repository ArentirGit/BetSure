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
        //$this->forward('BSOfferBundle:Offer:updateLabel');
        $this->forward('BSResultBundle:Result:get');
        //$this->forward('BSResultBundle:Result:updateResult');
        $this->forward('BSBetBundle:Bet:get', array('labelStrategy' => 'Home'));
        $this->forward('BSBetBundle:Bet:get', array('labelStrategy' => 'Nul'));
        $this->forward('BSBetBundle:Bet:get', array('labelStrategy' => 'Outside'));
        $this->forward('BSResultBundle:Result:offerToResult');
        $this->forward('BSBetBundle:Bet:update');
        $this->forward('BSResultBundle:Result:resultStrategyHome');

        return new Response("Hello World");
    }
}