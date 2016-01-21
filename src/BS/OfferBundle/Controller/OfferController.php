<?php

namespace BS\OfferBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use BS\OfferBundle\Entity\Offer;
use BS\OfferBundle\Entity\Outcome;



class OfferController extends Controller
{
    public function getAction()
    {
        ini_set('max_execution_time', 300); //300 seconds = 5 minutes
        $apiContentFootball = file_get_contents("https://www.parionssport.fr/api/1n2/offre?sport=100");
        $offerFootballInformations = json_decode($apiContentFootball);
        foreach($offerFootballInformations as $offer)
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
            foreach($offer->outcomes as $outcomes)
            {
                $localOutcome = new Outcome();
                $localOutcome->setOffer($localOffer);
                $localOutcome->setLabelOutcome($outcomes->label);
                $localOutcome->setCote($outcomes->cote);
                $em = $this->getDoctrine()->getManager();
                $em->persist($localOutcome);
                $em->flush();
            }
            foreach($offer->formules as $formule)
            {
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
                foreach($formule->outcomes as $outcomes)
                {
                    $localOutcome = new Outcome();
                    $localOutcome->setOffer($localOfferFormule);
                    $localOutcome->setLabelOutcome($outcomes->label);
                    $localOutcome->setCote($outcomes->cote);
                    $em = $this->getDoctrine()->getManager();
                    $em->persist($localOutcome);
                    $em->flush();
                }
                $em = $this->getDoctrine()->getManager();
                $em->persist($localOfferFormule);
                $em->flush();
            }
            $em = $this->getDoctrine()->getManager();
            $em->persist($localOffer);
            $em->flush();
        }


        $apiContentBasketball = file_get_contents("https://www.parionssport.fr/api/1n2/offre?sport=601600");
        $offerBasketballInformations = json_decode($apiContentBasketball);
        foreach($offerBasketballInformations as $offer)
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
            foreach($offer->outcomes as $outcomes)
            {
                $localOutcome = new Outcome();
                $localOutcome->setOffer($localOffer);
                $localOutcome->setLabelOutcome($outcomes->label);
                $localOutcome->setCote($outcomes->cote);
                $em = $this->getDoctrine()->getManager();
                $em->persist($localOutcome);
                $em->flush();
            }
            foreach($offer->formules as $formule)
            {
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
                foreach($formule->outcomes as $outcomes)
                {
                    $localOutcome = new Outcome();
                    $localOutcome->setOffer($localOfferFormule);
                    $localOutcome->setLabelOutcome($outcomes->label);
                    $localOutcome->setCote($outcomes->cote);
                    $em = $this->getDoctrine()->getManager();
                    $em->persist($localOutcome);
                    $em->flush();
                }
                $em = $this->getDoctrine()->getManager();
                $em->persist($localOfferFormule);
                $em->flush();
            }
            $em = $this->getDoctrine()->getManager();
            $em->persist($localOffer);
            $em->flush();
        }


        $apiContentTennis = file_get_contents("https://www.parionssport.fr/api/1n2/offre?sport=600");
        $offerTennisInformations = json_decode($apiContentTennis);
        foreach($offerTennisInformations as $offer)
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
            foreach($offer->outcomes as $outcomes)
            {
                $localOutcome = new Outcome();
                $localOutcome->setOffer($localOffer);
                $localOutcome->setLabelOutcome($outcomes->label);
                $localOutcome->setCote($outcomes->cote);
                $em = $this->getDoctrine()->getManager();
                $em->persist($localOutcome);
                $em->flush();
            }
            foreach($offer->formules as $formule)
            {
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
                foreach($formule->outcomes as $outcomes)
                {
                    $localOutcome = new Outcome();
                    $localOutcome->setOffer($localOfferFormule);
                    $localOutcome->setLabelOutcome($outcomes->label);
                    $localOutcome->setCote($outcomes->cote);
                    $em = $this->getDoctrine()->getManager();
                    $em->persist($localOutcome);
                    $em->flush();
                }
                $em = $this->getDoctrine()->getManager();
                $em->persist($localOfferFormule);
                $em->flush();
            }
            $em = $this->getDoctrine()->getManager();
            $em->persist($localOffer);
            $em->flush();
        }


        $apiContentRugby = file_get_contents("https://www.parionssport.fr/api/1n2/offre?sport=964500");
        $offerRugbyInformations = json_decode($apiContentRugby);
        foreach($offerRugbyInformations as $offer)
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
            foreach($offer->outcomes as $outcomes)
            {
                $localOutcome = new Outcome();
                $localOutcome->setOffer($localOffer);
                $localOutcome->setLabelOutcome($outcomes->label);
                $localOutcome->setCote($outcomes->cote);
                $em = $this->getDoctrine()->getManager();
                $em->persist($localOutcome);
                $em->flush();
            }
            foreach($offer->formules as $formule)
            {
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
                foreach($formule->outcomes as $outcomes)
                {
                    $localOutcome = new Outcome();
                    $localOutcome->setOffer($localOfferFormule);
                    $localOutcome->setLabelOutcome($outcomes->label);
                    $localOutcome->setCote($outcomes->cote);
                    $em = $this->getDoctrine()->getManager();
                    $em->persist($localOutcome);
                    $em->flush();
                }
                $em = $this->getDoctrine()->getManager();
                $em->persist($localOfferFormule);
                $em->flush();
            }
            $em = $this->getDoctrine()->getManager();
            $em->persist($localOffer);
            $em->flush();
        }


        $apiContentVolleyball = file_get_contents("https://www.parionssport.fr/api/1n2/offre?sport=1200");
        $offerVolleyballInformations = json_decode($apiContentVolleyball);
        foreach($offerVolleyballInformations as $offer)
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
            foreach($offer->outcomes as $outcomes)
            {
                $localOutcome = new Outcome();
                $localOutcome->setOffer($localOffer);
                $localOutcome->setLabelOutcome($outcomes->label);
                $localOutcome->setCote($outcomes->cote);
                $em = $this->getDoctrine()->getManager();
                $em->persist($localOutcome);
                $em->flush();
            }
            foreach($offer->formules as $formule)
            {
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
                foreach($formule->outcomes as $outcomes)
                {
                    $localOutcome = new Outcome();
                    $localOutcome->setOffer($localOfferFormule);
                    $localOutcome->setLabelOutcome($outcomes->label);
                    $localOutcome->setCote($outcomes->cote);
                    $em = $this->getDoctrine()->getManager();
                    $em->persist($localOutcome);
                    $em->flush();
                }
                $em = $this->getDoctrine()->getManager();
                $em->persist($localOfferFormule);
                $em->flush();
            }
            $em = $this->getDoctrine()->getManager();
            $em->persist($localOffer);
            $em->flush();
        }


        $apiContentHandball = file_get_contents("https://www.parionssport.fr/api/1n2/offre?sport=1100");
        $offerHandballInformations = json_decode($apiContentHandball);
        foreach($offerHandballInformations as $offer)
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
            foreach($offer->outcomes as $outcomes)
            {
                $localOutcome = new Outcome();
                $localOutcome->setOffer($localOffer);
                $localOutcome->setLabelOutcome($outcomes->label);
                $localOutcome->setCote($outcomes->cote);
                $em = $this->getDoctrine()->getManager();
                $em->persist($localOutcome);
                $em->flush();
            }
            foreach($offer->formules as $formule)
            {
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
                foreach($formule->outcomes as $outcomes)
                {
                    $localOutcome = new Outcome();
                    $localOutcome->setOffer($localOfferFormule);
                    $localOutcome->setLabelOutcome($outcomes->label);
                    $localOutcome->setCote($outcomes->cote);
                    $em = $this->getDoctrine()->getManager();
                    $em->persist($localOutcome);
                    $em->flush();
                }
                $em = $this->getDoctrine()->getManager();
                $em->persist($localOfferFormule);
                $em->flush();
            }
            $em = $this->getDoctrine()->getManager();
            $em->persist($localOffer);
            $em->flush();
        }


        $apiContentHockey = file_get_contents("https://www.parionssport.fr/api/1n2/offre?sport=2100");
        $offerHockeyInformations = json_decode($apiContentHockey);
        foreach($offerHockeyInformations as $offer)
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
            foreach($offer->outcomes as $outcomes)
            {
                $localOutcome = new Outcome();
                $localOutcome->setOffer($localOffer);
                $localOutcome->setLabelOutcome($outcomes->label);
                $localOutcome->setCote($outcomes->cote);
                $em = $this->getDoctrine()->getManager();
                $em->persist($localOutcome);
                $em->flush();
            }
            foreach($offer->formules as $formule)
            {
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
                foreach($formule->outcomes as $outcomes)
                {
                    $localOutcome = new Outcome();
                    $localOutcome->setOffer($localOfferFormule);
                    $localOutcome->setLabelOutcome($outcomes->label);
                    $localOutcome->setCote($outcomes->cote);
                    $em = $this->getDoctrine()->getManager();
                    $em->persist($localOutcome);
                    $em->flush();
                }
                $em = $this->getDoctrine()->getManager();
                $em->persist($localOfferFormule);
                $em->flush();
            }
            $em = $this->getDoctrine()->getManager();
            $em->persist($localOffer);
            $em->flush();
        }


        $apiContentUSFootball = file_get_contents("https://www.parionssport.fr/api/1n2/offre?sport=700");
        $offerUSFootballInformations = json_decode($apiContentUSFootball);
        foreach($offerUSFootballInformations as $offer)
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
            foreach($offer->outcomes as $outcomes)
            {
                $localOutcome = new Outcome();
                $localOutcome->setOffer($localOffer);
                $localOutcome->setLabelOutcome($outcomes->label);
                $localOutcome->setCote($outcomes->cote);
                $em = $this->getDoctrine()->getManager();
                $em->persist($localOutcome);
                $em->flush();
            }
            foreach($offer->formules as $formule)
            {
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
                foreach($formule->outcomes as $outcomes)
                {
                    $localOutcome = new Outcome();
                    $localOutcome->setOffer($localOfferFormule);
                    $localOutcome->setLabelOutcome($outcomes->label);
                    $localOutcome->setCote($outcomes->cote);
                    $em = $this->getDoctrine()->getManager();
                    $em->persist($localOutcome);
                    $em->flush();
                }
                $em = $this->getDoctrine()->getManager();
                $em->persist($localOfferFormule);
                $em->flush();
            }
            $em = $this->getDoctrine()->getManager();
            $em->persist($localOffer);
            $em->flush();
        }
        /*$apiContent = file_get_contents("https://www.parionssport.fr/api/1n2/resultats?date=20160118");
        $resultInformations = json_decode($apiContent);
        foreach($resultInformations as $result)
        {
            $localResult = new Result();
            $localResult->setId($result->eventId);
            $localResult->setEnd($result->end);
            $localResult->setEventLabel($result->label);
            $localResult->setCompetition($result->competition);
            $localResult->setCompetitionID($result->competitionID);
            foreach($result->marketRes as $marketRes)
            {
                $localMarketRes = new MarketResult();
                $localMarketRes->setId($marketRes->index);
                $localMarketRes->setMarketType($marketRes->marketType);
                $localMarketRes->setResultat($marketRes->resultat);
                $localMarketRes->setResult($localResult);
                $em = $this->getDoctrine()->getManager();
                $em->persist($localMarketRes);
                $em->flush();
            }
            $em = $this->getDoctrine()->getManager();
            $em->persist($localResult);
            $em->flush();
        }*/
        return new Response("Hello World");
    }
}