<?php

namespace BS\OfferBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use BS\OfferBundle\Entity\Offer;
use BS\OfferBundle\Entity\Outcome;



class OfferController extends Controller
{

    public function deleteDuplicateEntryAction()
    {
        ini_set('max_execution_time', 600); //300 seconds = 5 minutes

        $offerRepository = $this->getDoctrine()->getManager()->getRepository("BSOfferBundle:Offer");
        $duplicateOfferList = $offerRepository->getDuplicateEntry();

        $outcomeRepository = $this->getDoctrine()->getManager()->getRepository("BSOfferBundle:Outcome");

        $em = $this->getDoctrine()->getManager();
        foreach($duplicateOfferList as $duplicateOffer)
        {
            $outcomeList = $outcomeRepository->getOutcomeToDelete($duplicateOffer->getId());
            foreach($outcomeList as $outcome)
            {
                $em->remove($outcome);
                $em->flush();
            }
            $em->remove($duplicateOffer);
            $em->flush();
        }

        return new Response("Hello World");
    }

    public function getAction()
    {
        ini_set('max_execution_time', 600); //300 seconds = 5 minutes
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
                        $localOutcome->setLabelOutcome($outcomes->label);
                        $localOutcome->setCote($outcomes->cote);
                        $em = $this->getDoctrine()->getManager();
                        $em->persist($localOutcome);
                        $em->flush();
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
            }
        }

        /*if($offerFootballInformations != null)
        {
            foreach ($offerFootballInformations as $offer)
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
                    $localOutcome->setLabelOutcome($outcomes->label);
                    $localOutcome->setCote($outcomes->cote);
                    $em = $this->getDoctrine()->getManager();
                    $em->persist($localOutcome);
                    $em->flush();
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
        }


        $apiContentBasketball = file_get_contents("https://www.parionssport.fr/api/1n2/offre?sport=601600");
        $offerBasketballInformations = json_decode($apiContentBasketball);

        if($offerBasketballInformations != null) {
            foreach ($offerBasketballInformations as $offer) {
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
                    $localOutcome->setLabelOutcome($outcomes->label);
                    $localOutcome->setCote($outcomes->cote);
                    $em = $this->getDoctrine()->getManager();
                    $em->persist($localOutcome);
                    $em->flush();
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
        }

        $apiContentTennis = file_get_contents("https://www.parionssport.fr/api/1n2/offre?sport=600");
        $offerTennisInformations = json_decode($apiContentTennis);

        if($offerTennisInformations != null) {
            foreach ($offerTennisInformations as $offer) {
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
                    $localOutcome->setLabelOutcome($outcomes->label);
                    $localOutcome->setCote($outcomes->cote);
                    $em = $this->getDoctrine()->getManager();
                    $em->persist($localOutcome);
                    $em->flush();
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
        }

        $apiContentRugby = file_get_contents("https://www.parionssport.fr/api/1n2/offre?sport=964500");
        $offerRugbyInformations = json_decode($apiContentRugby);

        if($offerRugbyInformations != null)
        {
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
        }


        $apiContentVolleyball = file_get_contents("https://www.parionssport.fr/api/1n2/offre?sport=1200");
        $offerVolleyballInformations = json_decode($apiContentVolleyball);

        if($offerVolleyballInformations != null) {
            foreach ($offerVolleyballInformations as $offer) {
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
                    $localOutcome->setLabelOutcome($outcomes->label);
                    $localOutcome->setCote($outcomes->cote);
                    $em = $this->getDoctrine()->getManager();
                    $em->persist($localOutcome);
                    $em->flush();
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
        }


        $apiContentHandball = file_get_contents("https://www.parionssport.fr/api/1n2/offre?sport=1100");
        $offerHandballInformations = json_decode($apiContentHandball);

        if($offerHandballInformations != null) {
            foreach ($offerHandballInformations as $offer) {
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
                    $localOutcome->setLabelOutcome($outcomes->label);
                    $localOutcome->setCote($outcomes->cote);
                    $em = $this->getDoctrine()->getManager();
                    $em->persist($localOutcome);
                    $em->flush();
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
        }

        $apiContentHockey = file_get_contents("https://www.parionssport.fr/api/1n2/offre?sport=2100");
        $offerHockeyInformations = json_decode($apiContentHockey);

        if($offerHockeyInformations != null) {
            foreach ($offerHockeyInformations as $offer) {
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
                    $localOutcome->setLabelOutcome($outcomes->label);
                    $localOutcome->setCote($outcomes->cote);
                    $em = $this->getDoctrine()->getManager();
                    $em->persist($localOutcome);
                    $em->flush();
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
        }

        $apiContentUSFootball = file_get_contents("https://www.parionssport.fr/api/1n2/offre?sport=700");
        $offerUSFootballInformations = json_decode($apiContentUSFootball);

        if($offerUSFootballInformations != null) {
            foreach ($offerUSFootballInformations as $offer) {
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
                    $localOutcome->setLabelOutcome($outcomes->label);
                    $localOutcome->setCote($outcomes->cote);
                    $em = $this->getDoctrine()->getManager();
                    $em->persist($localOutcome);
                    $em->flush();
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
        }*/

        return new Response("Hello World");
    }
}