<?php

namespace BS\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class MainController extends Controller
{
    public function mainAction()
    {
        ini_set('max_execution_time', 18000);
        ini_set('memory_limit', '-1');

        $this->forward('BSOfferBundle:Offer:get');
        $this->forward('BSResultBundle:Result:get');

        $this->forward('BSBetBundle:Bet:getBetweenPrice', array('labelStrategy' => 'HomeBetween110120', 'outcomeLowCote' => '1,10', 'outcomeUpCote' => '1,20'));
        $this->forward('BSBetBundle:Bet:getBetweenPrice', array('labelStrategy' => 'HomeBetween120130', 'outcomeLowCote' => '1,20', 'outcomeUpCote' => '1,30'));
        $this->forward('BSBetBundle:Bet:getBetweenPrice', array('labelStrategy' => 'HomeBetween130140', 'outcomeLowCote' => '1,30', 'outcomeUpCote' => '1,40'));
        $this->forward('BSBetBundle:Bet:getBetweenPrice', array('labelStrategy' => 'HomeBetween140150', 'outcomeLowCote' => '1,40', 'outcomeUpCote' => '1,50'));
        $this->forward('BSBetBundle:Bet:getBetweenPrice', array('labelStrategy' => 'HomeBetween150160', 'outcomeLowCote' => '1,50', 'outcomeUpCote' => '1,60'));
        $this->forward('BSBetBundle:Bet:getBetweenPrice', array('labelStrategy' => 'HomeBetween160170', 'outcomeLowCote' => '1,60', 'outcomeUpCote' => '1,70'));
        $this->forward('BSBetBundle:Bet:getBetweenPrice', array('labelStrategy' => 'HomeBetween170180', 'outcomeLowCote' => '1,70', 'outcomeUpCote' => '1,80'));
        $this->forward('BSBetBundle:Bet:getBetweenPrice', array('labelStrategy' => 'HomeBetween180190', 'outcomeLowCote' => '1,80', 'outcomeUpCote' => '1,90'));
        $this->forward('BSBetBundle:Bet:getBetweenPrice', array('labelStrategy' => 'HomeBetween190200', 'outcomeLowCote' => '1,90', 'outcomeUpCote' => '2,00'));

        $this->forward('BSBetBundle:Bet:getBetweenPrice', array('labelStrategy' => 'HomeBetween200220', 'outcomeLowCote' => '2,00', 'outcomeUpCote' => '2,20'));
        $this->forward('BSBetBundle:Bet:getBetweenPrice', array('labelStrategy' => 'HomeBetween220240', 'outcomeLowCote' => '2,20', 'outcomeUpCote' => '2,40'));
        $this->forward('BSBetBundle:Bet:getBetweenPrice', array('labelStrategy' => 'HomeBetween240260', 'outcomeLowCote' => '2,40', 'outcomeUpCote' => '2,60'));
        $this->forward('BSBetBundle:Bet:getBetweenPrice', array('labelStrategy' => 'HomeBetween260280', 'outcomeLowCote' => '2,60', 'outcomeUpCote' => '2,80'));
        $this->forward('BSBetBundle:Bet:getBetweenPrice', array('labelStrategy' => 'HomeBetween280300', 'outcomeLowCote' => '2,80', 'outcomeUpCote' => '3,00'));

        $this->forward('BSBetBundle:Bet:getBetweenPrice', array('labelStrategy' => 'HomeBetween300350', 'outcomeLowCote' => '3,00', 'outcomeUpCote' => '3,50'));
        $this->forward('BSBetBundle:Bet:getBetweenPrice', array('labelStrategy' => 'HomeBetween350400', 'outcomeLowCote' => '3,50', 'outcomeUpCote' => '4,00'));

        $this->forward('BSBetBundle:Bet:getMinimumPrice', array('labelStrategy' => 'HomeUpper400', 'outcomeCote' => '4,00'));

        $this->forward('BSBetBundle:Bet:getBetweenPrice', array('labelStrategy' => 'OutsideBetween110120', 'outcomeLowCote' => '1,10', 'outcomeUpCote' => '1,20'));
        $this->forward('BSBetBundle:Bet:getBetweenPrice', array('labelStrategy' => 'OutsideBetween120130', 'outcomeLowCote' => '1,20', 'outcomeUpCote' => '1,30'));
        $this->forward('BSBetBundle:Bet:getBetweenPrice', array('labelStrategy' => 'OutsideBetween130140', 'outcomeLowCote' => '1,30', 'outcomeUpCote' => '1,40'));
        $this->forward('BSBetBundle:Bet:getBetweenPrice', array('labelStrategy' => 'OutsideBetween140150', 'outcomeLowCote' => '1,40', 'outcomeUpCote' => '1,50'));
        $this->forward('BSBetBundle:Bet:getBetweenPrice', array('labelStrategy' => 'OutsideBetween150160', 'outcomeLowCote' => '1,50', 'outcomeUpCote' => '1,60'));
        $this->forward('BSBetBundle:Bet:getBetweenPrice', array('labelStrategy' => 'OutsideBetween160170', 'outcomeLowCote' => '1,60', 'outcomeUpCote' => '1,70'));
        $this->forward('BSBetBundle:Bet:getBetweenPrice', array('labelStrategy' => 'OutsideBetween170180', 'outcomeLowCote' => '1,70', 'outcomeUpCote' => '1,80'));
        $this->forward('BSBetBundle:Bet:getBetweenPrice', array('labelStrategy' => 'OutsideBetween180190', 'outcomeLowCote' => '1,80', 'outcomeUpCote' => '1,90'));
        $this->forward('BSBetBundle:Bet:getBetweenPrice', array('labelStrategy' => 'OutsideBetween190200', 'outcomeLowCote' => '1,90', 'outcomeUpCote' => '2,00'));

        $this->forward('BSBetBundle:Bet:getBetweenPrice', array('labelStrategy' => 'OutsideBetween200220', 'outcomeLowCote' => '2,00', 'outcomeUpCote' => '2,20'));
        $this->forward('BSBetBundle:Bet:getBetweenPrice', array('labelStrategy' => 'OutsideBetween220240', 'outcomeLowCote' => '2,20', 'outcomeUpCote' => '2,40'));
        $this->forward('BSBetBundle:Bet:getBetweenPrice', array('labelStrategy' => 'OutsideBetween240260', 'outcomeLowCote' => '2,40', 'outcomeUpCote' => '2,60'));
        $this->forward('BSBetBundle:Bet:getBetweenPrice', array('labelStrategy' => 'OutsideBetween260280', 'outcomeLowCote' => '2,60', 'outcomeUpCote' => '2,80'));
        $this->forward('BSBetBundle:Bet:getBetweenPrice', array('labelStrategy' => 'OutsideBetween280300', 'outcomeLowCote' => '2,80', 'outcomeUpCote' => '3,00'));

        $this->forward('BSBetBundle:Bet:getBetweenPrice', array('labelStrategy' => 'OutsideBetween300350', 'outcomeLowCote' => '3,00', 'outcomeUpCote' => '3,50'));
        $this->forward('BSBetBundle:Bet:getBetweenPrice', array('labelStrategy' => 'OutsideBetween350400', 'outcomeLowCote' => '3,50', 'outcomeUpCote' => '4,00'));

        $this->forward('BSBetBundle:Bet:getMinimumPrice', array('labelStrategy' => 'OutsideUpper400', 'outcomeCote' => '4,00'));


        $this->forward('BSResultBundle:Result:offerToResult');
        $this->forward('BSBetBundle:Bet:update');




        /*$this->forward('BSResultBundle:Result:resultStrategy', array('strategyLabel' => 'HomeBetween110120'));
        $this->forward('BSResultBundle:Result:resultStrategy', array('strategyLabel' => 'HomeBetween120130'));
        $this->forward('BSResultBundle:Result:resultStrategy', array('strategyLabel' => 'HomeBetween130140'));
        $this->forward('BSResultBundle:Result:resultStrategy', array('strategyLabel' => 'HomeBetween140150'));
        $this->forward('BSResultBundle:Result:resultStrategy', array('strategyLabel' => 'HomeBetween150160'));
        $this->forward('BSResultBundle:Result:resultStrategy', array('strategyLabel' => 'HomeBetween160170'));
        $this->forward('BSResultBundle:Result:resultStrategy', array('strategyLabel' => 'HomeBetween170180'));
        $this->forward('BSResultBundle:Result:resultStrategy', array('strategyLabel' => 'HomeBetween180190'));
        $this->forward('BSResultBundle:Result:resultStrategy', array('strategyLabel' => 'HomeBetween190200'));

        $this->forward('BSResultBundle:Result:resultStrategy', array('strategyLabel' => 'HomeBetween200220'));
        $this->forward('BSResultBundle:Result:resultStrategy', array('strategyLabel' => 'HomeBetween220240'));
        $this->forward('BSResultBundle:Result:resultStrategy', array('strategyLabel' => 'HomeBetween240260'));
        $this->forward('BSResultBundle:Result:resultStrategy', array('strategyLabel' => 'HomeBetween260280'));
        $this->forward('BSResultBundle:Result:resultStrategy', array('strategyLabel' => 'HomeBetween280300'));

        $this->forward('BSResultBundle:Result:resultStrategy', array('strategyLabel' => 'HomeBetween300350'));
        $this->forward('BSResultBundle:Result:resultStrategy', array('strategyLabel' => 'HomeBetween350400'));

        $this->forward('BSResultBundle:Result:resultStrategy', array('strategyLabel' => 'HomeUpper400'));

        $this->forward('BSResultBundle:Result:resultStrategy', array('strategyLabel' => 'OutsideBetween110120'));
        $this->forward('BSResultBundle:Result:resultStrategy', array('strategyLabel' => 'OutsideBetween120130'));
        $this->forward('BSResultBundle:Result:resultStrategy', array('strategyLabel' => 'OutsideBetween130140'));
        $this->forward('BSResultBundle:Result:resultStrategy', array('strategyLabel' => 'OutsideBetween140150'));
        $this->forward('BSResultBundle:Result:resultStrategy', array('strategyLabel' => 'OutsideBetween150160'));
        $this->forward('BSResultBundle:Result:resultStrategy', array('strategyLabel' => 'OutsideBetween160170'));
        $this->forward('BSResultBundle:Result:resultStrategy', array('strategyLabel' => 'OutsideBetween170180'));
        $this->forward('BSResultBundle:Result:resultStrategy', array('strategyLabel' => 'OutsideBetween180190'));
        $this->forward('BSResultBundle:Result:resultStrategy', array('strategyLabel' => 'OutsideBetween190200'));

        $this->forward('BSResultBundle:Result:resultStrategy', array('strategyLabel' => 'OutsideBetween200220'));
        $this->forward('BSResultBundle:Result:resultStrategy', array('strategyLabel' => 'OutsideBetween220240'));
        $this->forward('BSResultBundle:Result:resultStrategy', array('strategyLabel' => 'OutsideBetween240260'));
        $this->forward('BSResultBundle:Result:resultStrategy', array('strategyLabel' => 'OutsideBetween260280'));
        $this->forward('BSResultBundle:Result:resultStrategy', array('strategyLabel' => 'OutsideBetween280300'));

        $this->forward('BSResultBundle:Result:resultStrategy', array('strategyLabel' => 'OutsideBetween300350'));
        $this->forward('BSResultBundle:Result:resultStrategy', array('strategyLabel' => 'OutsideBetween350400'));

        $this->forward('BSResultBundle:Result:resultStrategy', array('strategyLabel' => 'OutsideUpper400'));*/




        /*$this->forward('BSBetBundle:Bet:getBetweenPriceWBS', array('labelStrategy' => 'HomeBetween110120', 'outcomeLowCote' => '1,10', 'outcomeUpCote' => '1,20'));
        $this->forward('BSBetBundle:Bet:getBetweenPriceWBS', array('labelStrategy' => 'HomeBetween120130', 'outcomeLowCote' => '1,20', 'outcomeUpCote' => '1,30'));
        $this->forward('BSBetBundle:Bet:getBetweenPriceWBS', array('labelStrategy' => 'HomeBetween130140', 'outcomeLowCote' => '1,30', 'outcomeUpCote' => '1,40'));
        $this->forward('BSBetBundle:Bet:getBetweenPriceWBS', array('labelStrategy' => 'HomeBetween140150', 'outcomeLowCote' => '1,40', 'outcomeUpCote' => '1,50'));
        $this->forward('BSBetBundle:Bet:getBetweenPriceWBS', array('labelStrategy' => 'HomeBetween150160', 'outcomeLowCote' => '1,50', 'outcomeUpCote' => '1,60'));
        $this->forward('BSBetBundle:Bet:getBetweenPriceWBS', array('labelStrategy' => 'HomeBetween160170', 'outcomeLowCote' => '1,60', 'outcomeUpCote' => '1,70'));
        $this->forward('BSBetBundle:Bet:getBetweenPriceWBS', array('labelStrategy' => 'HomeBetween170180', 'outcomeLowCote' => '1,70', 'outcomeUpCote' => '1,80'));
        $this->forward('BSBetBundle:Bet:getBetweenPriceWBS', array('labelStrategy' => 'HomeBetween180190', 'outcomeLowCote' => '1,80', 'outcomeUpCote' => '1,90'));
        $this->forward('BSBetBundle:Bet:getBetweenPriceWBS', array('labelStrategy' => 'HomeBetween190200', 'outcomeLowCote' => '1,90', 'outcomeUpCote' => '2,00'));

        $this->forward('BSBetBundle:Bet:getBetweenPriceWBS', array('labelStrategy' => 'HomeBetween200220', 'outcomeLowCote' => '2,00', 'outcomeUpCote' => '2,20'));
        $this->forward('BSBetBundle:Bet:getBetweenPriceWBS', array('labelStrategy' => 'HomeBetween220240', 'outcomeLowCote' => '2,20', 'outcomeUpCote' => '2,40'));
        $this->forward('BSBetBundle:Bet:getBetweenPriceWBS', array('labelStrategy' => 'HomeBetween240260', 'outcomeLowCote' => '2,40', 'outcomeUpCote' => '2,60'));
        $this->forward('BSBetBundle:Bet:getBetweenPriceWBS', array('labelStrategy' => 'HomeBetween260280', 'outcomeLowCote' => '2,60', 'outcomeUpCote' => '2,80'));
        $this->forward('BSBetBundle:Bet:getBetweenPriceWBS', array('labelStrategy' => 'HomeBetween280300', 'outcomeLowCote' => '2,80', 'outcomeUpCote' => '3,00'));

        $this->forward('BSBetBundle:Bet:getBetweenPriceWBS', array('labelStrategy' => 'HomeBetween300350', 'outcomeLowCote' => '3,00', 'outcomeUpCote' => '3,50'));
        $this->forward('BSBetBundle:Bet:getBetweenPriceWBS', array('labelStrategy' => 'HomeBetween350400', 'outcomeLowCote' => '3,50', 'outcomeUpCote' => '4,00'));

        $this->forward('BSBetBundle:Bet:getMinimumPriceWBS', array('labelStrategy' => 'HomeUpper400', 'outcomeCote' => '4,00'));

        $this->forward('BSBetBundle:Bet:getBetweenPriceWBS', array('labelStrategy' => 'OutsideBetween110120', 'outcomeLowCote' => '1,10', 'outcomeUpCote' => '1,20'));
        $this->forward('BSBetBundle:Bet:getBetweenPriceWBS', array('labelStrategy' => 'OutsideBetween120130', 'outcomeLowCote' => '1,20', 'outcomeUpCote' => '1,30'));
        $this->forward('BSBetBundle:Bet:getBetweenPriceWBS', array('labelStrategy' => 'OutsideBetween130140', 'outcomeLowCote' => '1,30', 'outcomeUpCote' => '1,40'));
        $this->forward('BSBetBundle:Bet:getBetweenPriceWBS', array('labelStrategy' => 'OutsideBetween140150', 'outcomeLowCote' => '1,40', 'outcomeUpCote' => '1,50'));
        $this->forward('BSBetBundle:Bet:getBetweenPriceWBS', array('labelStrategy' => 'OutsideBetween150160', 'outcomeLowCote' => '1,50', 'outcomeUpCote' => '1,60'));
        $this->forward('BSBetBundle:Bet:getBetweenPriceWBS', array('labelStrategy' => 'OutsideBetween160170', 'outcomeLowCote' => '1,60', 'outcomeUpCote' => '1,70'));
        $this->forward('BSBetBundle:Bet:getBetweenPriceWBS', array('labelStrategy' => 'OutsideBetween170180', 'outcomeLowCote' => '1,70', 'outcomeUpCote' => '1,80'));
        $this->forward('BSBetBundle:Bet:getBetweenPriceWBS', array('labelStrategy' => 'OutsideBetween180190', 'outcomeLowCote' => '1,80', 'outcomeUpCote' => '1,90'));
        $this->forward('BSBetBundle:Bet:getBetweenPriceWBS', array('labelStrategy' => 'OutsideBetween190200', 'outcomeLowCote' => '1,90', 'outcomeUpCote' => '2,00'));

        $this->forward('BSBetBundle:Bet:getBetweenPriceWBS', array('labelStrategy' => 'OutsideBetween200220', 'outcomeLowCote' => '2,00', 'outcomeUpCote' => '2,20'));
        $this->forward('BSBetBundle:Bet:getBetweenPriceWBS', array('labelStrategy' => 'OutsideBetween220240', 'outcomeLowCote' => '2,20', 'outcomeUpCote' => '2,40'));
        $this->forward('BSBetBundle:Bet:getBetweenPriceWBS', array('labelStrategy' => 'OutsideBetween240260', 'outcomeLowCote' => '2,40', 'outcomeUpCote' => '2,60'));
        $this->forward('BSBetBundle:Bet:getBetweenPriceWBS', array('labelStrategy' => 'OutsideBetween260280', 'outcomeLowCote' => '2,60', 'outcomeUpCote' => '2,80'));
        $this->forward('BSBetBundle:Bet:getBetweenPriceWBS', array('labelStrategy' => 'OutsideBetween280300', 'outcomeLowCote' => '2,80', 'outcomeUpCote' => '3,00'));

        $this->forward('BSBetBundle:Bet:getBetweenPriceWBS', array('labelStrategy' => 'OutsideBetween300350', 'outcomeLowCote' => '3,00', 'outcomeUpCote' => '3,50'));
        $this->forward('BSBetBundle:Bet:getBetweenPriceWBS', array('labelStrategy' => 'OutsideBetween350400', 'outcomeLowCote' => '3,50', 'outcomeUpCote' => '4,00'));

        $this->forward('BSBetBundle:Bet:getMinimumPriceWBS', array('labelStrategy' => 'OutsideUpper400', 'outcomeCote' => '4,00'));*/

        //$this->forward('BSBetBundle:Bet:update');


        /*$this->forward('BSResultBundle:Result:resultStrategy', array('strategyLabel' => 'HomeBetween110120WBS'));
        $this->forward('BSResultBundle:Result:resultStrategy', array('strategyLabel' => 'HomeBetween120130WBS'));
        $this->forward('BSResultBundle:Result:resultStrategy', array('strategyLabel' => 'HomeBetween130140WBS'));
        $this->forward('BSResultBundle:Result:resultStrategy', array('strategyLabel' => 'HomeBetween140150WBS'));
        $this->forward('BSResultBundle:Result:resultStrategy', array('strategyLabel' => 'HomeBetween150160WBS'));
        $this->forward('BSResultBundle:Result:resultStrategy', array('strategyLabel' => 'HomeBetween160170WBS'));
        $this->forward('BSResultBundle:Result:resultStrategy', array('strategyLabel' => 'HomeBetween170180WBS'));
        $this->forward('BSResultBundle:Result:resultStrategy', array('strategyLabel' => 'HomeBetween180190WBS'));
        $this->forward('BSResultBundle:Result:resultStrategy', array('strategyLabel' => 'HomeBetween190200WBS'));

        $this->forward('BSResultBundle:Result:resultStrategy', array('strategyLabel' => 'HomeBetween200220WBS'));
        $this->forward('BSResultBundle:Result:resultStrategy', array('strategyLabel' => 'HomeBetween220240WBS'));
        $this->forward('BSResultBundle:Result:resultStrategy', array('strategyLabel' => 'HomeBetween240260WBS'));
        $this->forward('BSResultBundle:Result:resultStrategy', array('strategyLabel' => 'HomeBetween260280WBS'));
        $this->forward('BSResultBundle:Result:resultStrategy', array('strategyLabel' => 'HomeBetween280300WBS'));

        $this->forward('BSResultBundle:Result:resultStrategy', array('strategyLabel' => 'HomeBetween300350WBS'));
        $this->forward('BSResultBundle:Result:resultStrategy', array('strategyLabel' => 'HomeBetween350400WBS'));

        $this->forward('BSResultBundle:Result:resultStrategy', array('strategyLabel' => 'HomeUpper400WBS'));

        $this->forward('BSResultBundle:Result:resultStrategy', array('strategyLabel' => 'OutsideBetween110120WBS'));
        $this->forward('BSResultBundle:Result:resultStrategy', array('strategyLabel' => 'OutsideBetween120130WBS'));
        $this->forward('BSResultBundle:Result:resultStrategy', array('strategyLabel' => 'OutsideBetween130140WBS'));
        $this->forward('BSResultBundle:Result:resultStrategy', array('strategyLabel' => 'OutsideBetween140150WBS'));
        $this->forward('BSResultBundle:Result:resultStrategy', array('strategyLabel' => 'OutsideBetween150160WBS'));
        $this->forward('BSResultBundle:Result:resultStrategy', array('strategyLabel' => 'OutsideBetween160170WBS'));
        $this->forward('BSResultBundle:Result:resultStrategy', array('strategyLabel' => 'OutsideBetween170180WBS'));
        $this->forward('BSResultBundle:Result:resultStrategy', array('strategyLabel' => 'OutsideBetween180190WBS'));
        $this->forward('BSResultBundle:Result:resultStrategy', array('strategyLabel' => 'OutsideBetween190200WBS'));

        $this->forward('BSResultBundle:Result:resultStrategy', array('strategyLabel' => 'OutsideBetween200220WBS'));
        $this->forward('BSResultBundle:Result:resultStrategy', array('strategyLabel' => 'OutsideBetween220240WBS'));
        $this->forward('BSResultBundle:Result:resultStrategy', array('strategyLabel' => 'OutsideBetween240260WBS'));
        $this->forward('BSResultBundle:Result:resultStrategy', array('strategyLabel' => 'OutsideBetween260280WBS'));
        $this->forward('BSResultBundle:Result:resultStrategy', array('strategyLabel' => 'OutsideBetween280300WBS'));

        $this->forward('BSResultBundle:Result:resultStrategy', array('strategyLabel' => 'OutsideBetween300350WBS'));
        $this->forward('BSResultBundle:Result:resultStrategy', array('strategyLabel' => 'OutsideBetween350400WBS'));

        $this->forward('BSResultBundle:Result:resultStrategy', array('strategyLabel' => 'OutsideUpper400WBS'));*/

        $this->forward('BSBetBundle:Bet:getToPlay');

        return new Response("Hello World");
    }
}