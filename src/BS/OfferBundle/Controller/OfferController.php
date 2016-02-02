<?php

namespace BS\OfferBundle\Controller;

use Proxies\__CG__\BS\ResultBundle\Entity\Result;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use BS\OfferBundle\Entity\Offer;
use BS\OfferBundle\Entity\Outcome;



class OfferController extends Controller
{
    public function  updateHomeOutsideAction(){
        $repositoryOffer = $this->getDoctrine()->getManager()->getRepository('BSOfferBundle:Offer');
        $repositoryTeam = $this->getDoctrine()->getManager()->getRepository('BSTeamBundle:Team');
        $OfferList = $repositoryOffer->findAll();
        foreach($OfferList as $Offer){
            List($dom, $ext) = explode("-", $Offer->getLabelOffer());
            $teamDomId = $repositoryTeam->getIdByName($dom);
            $teamExtId = $repositoryTeam->getIdByName($ext);
            if(!empty($teamDomId) and !empty($teamExtId)){
                $Offer->setHomeTeamId($teamDomId[0]['id']);
                $Offer->setOutsideTeamId($teamExtId[0]['id']);

                $em = $this->getDoctrine()->getManager();
                $em->persist($Offer);
                $em->flush();

            }
        }
        return new Response("Hello world");
    }

    /*public function updateLabelAction()
    {
        $outcomeRepository = $this->getDoctrine()->getManager()->getRepository('BSOfferBundle:Outcome');
        $outcomeList = $outcomeRepository->findAll();
        foreach($outcomeList as $outcome)
        {
            if($outcome->getLabelOutcome() == "1")
            {
                $outcome->setLabelOutcome("Domicile");
                $em = $this->getDoctrine()->getManager();
                $em->persist($outcome);
                $em->flush();
            }
            elseif($outcome->getLabelOutcome() == "2")
            {
                $outcome->setLabelOutcome("Exterieur");
                $em = $this->getDoctrine()->getManager();
                $em->persist($outcome);
                $em->flush();
            }
        }

        return new Response("Hello World");
    }*/

    /*
     * Génère les offres du jour
     * Ne permet pas la présence de doublon
     */
    public function getAction()
    {
        ini_set('max_execution_time', 18000);
        $offerInformationsArray = array();
        $apiContentFootball = file_get_contents("https://www.parionssport.fr/api/1n2/offre?sport=100");
        $offerFootballInformations = json_decode($apiContentFootball);
        $apiContentBasketball = file_get_contents("https://www.parionssport.fr/api/1n2/offre?sport=601600");
        $offerBasketballInformations = json_decode($apiContentBasketball);
        $apiContentTennis = file_get_contents("https://www.parionssport.fr/api/1n2/offre?sport=600");
        $offerTennisInformations = json_decode($apiContentTennis);
        $apiContentRugby = file_get_contents("https://www.parionssport.fr/api/1n2/offre?sport=964500");
        $offerRugbyInformations = json_decode($apiContentRugby);
        $apiContentVolleyball = file_get_contents("https://www.parionssport.fr/api/1n2/offre?sport=1200");
        $offerVolleyballInformations = json_decode($apiContentVolleyball);
        $apiContentHandball = file_get_contents("https://www.parionssport.fr/api/1n2/offre?sport=1100");
        $offerHandballInformations = json_decode($apiContentHandball);
        $apiContentHockey = file_get_contents("https://www.parionssport.fr/api/1n2/offre?sport=2100");
        $offerHockeyInformations = json_decode($apiContentHockey);
        $apiContentUSFootball = file_get_contents("https://www.parionssport.fr/api/1n2/offre?sport=700");
        $offerUSFootballInformations = json_decode($apiContentUSFootball);
        array_push($offerInformationsArray, $offerFootballInformations);
        array_push($offerInformationsArray, $offerBasketballInformations);
        array_push($offerInformationsArray, $offerTennisInformations);
        array_push($offerInformationsArray, $offerRugbyInformations);
        array_push($offerInformationsArray, $offerVolleyballInformations);
        array_push($offerInformationsArray, $offerHandballInformations);
        array_push($offerInformationsArray, $offerHockeyInformations);
        array_push($offerInformationsArray, $offerUSFootballInformations);

        $repositoryOffer = $this->getDoctrine()->getManager()->getRepository('BSOfferBundle:Offer');
        $repositoryOutcome = $this->getDoctrine()->getManager()->getRepository('BSOfferBundle:Outcome');

        foreach($offerInformationsArray as $offerInformations)
        {
            if($offerInformations != null)
            {
                foreach ($offerInformations as $offer)
                {
                    $localOffer = new Offer();
                    $localOffer->setEventId($offer->eventId);
                    $localOffer->setMarketId($offer->marketId);
                    $localOffer->setSportId($offer->sportId);
                    $localOffer->setIndexOffer($offer->index);
                    $localOffer->setMarketType($offer->marketType);
                    $localOffer->setEnd($offer->end);
                    $localOffer->setLabelOffer($offer->label);
                    $localOffer->setCompetition($offer->competition);
                    $localOffer->setCompetitionId($offer->competitionId);
                    foreach ($offer->outcomes as $outcomes) {
                        $localOutcome = new Outcome();
                        $localOutcome->setOffer($localOffer);
                        if($outcomes->label == "1")
                        {
                            $localOutcomeLabel = "Domicile";
                            $localOutcome->setLabelOutcome("$localOutcomeLabel");
                        }
                        elseif($outcomes->label == "2")
                        {
                            $localOutcomeLabel = "Exterieur";

                            $localOutcome->setLabelOutcome($localOutcomeLabel);
                        }
                        else {
                            $localOutcomeLabel = $outcomes->label;
                            $localOutcome->setLabelOutcome($localOutcomeLabel);
                        }
                        $localOutcome->setCote($outcomes->cote);
                        $localOutcome->setEventId($offer->eventId);
                        $localOutcome->setIndexOffer($offer->index);
                        $duplicateOutcome = $repositoryOutcome->verifyDuplicate($localOutcomeLabel, $offer);
                        if(empty($duplicateOutcome))
                        {
                            $em = $this->getDoctrine()->getManager();
                            $em->persist($localOutcome);
                            $em->flush();
                        }
                    }
                    foreach ($offer->formules as $formule) {
                        $localOfferFormule = new Offer();
                        $localOfferFormule->setEventId($formule->eventId);
                        $localOfferFormule->setMarketId($offer->marketId);
                        $localOfferFormule->setSportId($formule->sportId);
                        $localOfferFormule->setIndexOffer($formule->index);
                        $localOfferFormule->setMarketType($formule->marketType);
                        $localOfferFormule->setEnd($formule->end);
                        $localOfferFormule->setLabelOffer($formule->label);
                        $localOfferFormule->setCompetition($formule->competition);
                        $localOfferFormule->setCompetitionId($offer->competitionId);
                        foreach ($formule->outcomes as $outcomes) {
                            $localOutcome = new Outcome();
                            $localOutcome->setOffer($localOfferFormule);
                            if($outcomes->label == "1")
                            {
                                $localOutcomeLabel = "Domicile";
                                $localOutcome->setLabelOutcome("$localOutcomeLabel");
                            }
                            elseif($outcomes->label == "2")
                            {
                                $localOutcomeLabel = "Exterieur";

                                $localOutcome->setLabelOutcome($localOutcomeLabel);
                            }
                            else {
                                $localOutcomeLabel = $outcomes->label;
                                $localOutcome->setLabelOutcome($localOutcomeLabel);
                            }
                            $localOutcome->setCote($outcomes->cote);
                            $localOutcome->setEventId($formule->eventId);
                            $localOutcome->setIndexOffer($formule->index);
                            $duplicateOutcome = $repositoryOutcome->verifyDuplicate($localOutcomeLabel, $formule);
                            if(empty($duplicateOutcome))
                            {
                                $em = $this->getDoctrine()->getManager();
                                $em->persist($localOutcome);
                                $em->flush();
                            }
                        }

                        $duplicateFormule = $repositoryOffer->verifyDuplicate($formule);
                        if(empty($duplicateFormule)) {
                            $em = $this->getDoctrine()->getManager();
                            $em->persist($localOfferFormule);
                            $em->flush();
                        }
                    }
                    $duplicateOffer = $repositoryOffer->verifyDuplicate($offer);
                    if(empty($duplicateOffer)) {
                        $em = $this->getDoctrine()->getManager();
                        $em->persist($localOffer);
                        $em->flush();
                    }
                }
            }
        }


        return new Response("Hello World");
    }
}