<?php
namespace BS\TeamBundle\Controller;

use BS\TeamBundle\Entity\Team;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use BS\ResultBundle\Repository;
/**
 * Created by PhpStorm.
 * User: Björn
 * Date: 29/01/2016
 * Time: 17:16
 */
class TeamController extends Controller
{
    public function getAction()
    {
        ini_set('max_execution_time', 18000);
        $repositoryResult = $this->getDoctrine()->getManager()->getRepository('BSResultBundle:Result');
        $ResultList = $repositoryResult->getAllResult();
        //getting the title of a match
        $repositoryTeam = $this->getDoctrine()->getManager()->getRepository('BSTeamBundle:Team');
        foreach ($ResultList as $Result) {
            List($dom, $ext) = explode("-", $Result->getEventLabel());
            // parsing of team name with match title
            $teamList = $repositoryTeam->verifyDuplicate($dom, $Result->getCompetitionID());
            //verify if a home playing team is already present in the Team table
            if(empty($teamList)){
                $team = new Team();
                $team->setName($dom);
                $team->setCompetitionId($Result->getCompetitionID());
                $em = $this->getDoctrine()->getManager();
                $em->persist($team);
                $em->flush();
                // add in the Team table the home team
                var_dump($team);
            }
            $teamList = $repositoryTeam->verifyDuplicate($ext, $Result->getCompetitionID());
            if(empty($teamList)){
                $team = new Team();
                $team->setName($ext);
                $team->setCompetitionId($Result->getCompetitionID());
                $em = $this->getDoctrine()->getManager();
                $em->persist($team);
                $em->flush();
                var_dump($team);
            }
            $teamHome = $repositoryTeam->verifyDuplicate($dom, $Result->getCompetitionID());
            $teamOutside = $repositoryTeam->verifyDuplicate($ext, $Result->getCompetitionID());
            $Result->setHomeTeamId($teamHome[0]->getId());
            $Result->setOutsideTeamId($teamOutside[0]->getId());
            $em = $this->getDoctrine()->getManager();
            $em->persist($Result);
            $em->flush();
        }
        return new Response('');
    }

    public function initSeasonAction(){

        ini_set('max_execution_time', 18000);
        $teamRepository = $this->getDoctrine()->getManager()->getRepository('BSTeamBundle:Team');
        $teamList = $teamRepository->findAll();

        foreach($teamList as $team) {
            $team->setHomeVictory("0");
            $team->setHomeDefeat("0");
            $team->setOutsideVictory("0");
            $team->setOutsideDefeat("0");
            $team->setRank("0");
            $team->setPoints("0");
            $em = $this->getDoctrine()->getManager();
            $em->persist($team);
            $em->flush();
        }
        return new Response('');
    }

    public function getTeamResultAction(){
        ini_set('max_execution_time', 18000);

        $teamRepository = $this->getDoctrine()->getManager()->getRepository('BSTeamBundle:Team');
        $teamList = $teamRepository->findAll();
        $marketRepository = $this->getDoctrine()->getManager()->getRepository('BSResultBundle:MarketResult');

        foreach($teamList as $team){
            $resultAndMarketList = $marketRepository->getResultJoinMarket($team->getId());
            foreach($resultAndMarketList as $result){
                //var_dump($result);
                if($result->getResult()->getSportId() == 100 and $result->getResult()->getCompetitionID() == $team->getCompetitionId()) {
                    var_dump($team->getName() + " : " + $team->getCompetition() + "\n" + $result->getResult()->getCompetitionID());
                    if ($result->getResult()->getHomeTeamId() == $team->getId()) {
                        if ($result->getResultat() == 'Domicile') {
                            $team->setHomeVictory($team->getHomeVictory() + 1);
                            $team->setPoints($team->getPoints() + 3);
                            $em = $this->getDoctrine()->getManager();
                            $em->persist($team);
                            $em->flush();
                        } else if ($result->getResultat() == 'Exterieur') {
                            $team->setOutsideDefeat($team->getOutsideDefeat() + 1);
                            $em = $this->getDoctrine()->getManager();
                            $em->persist($team);
                            $em->flush();
                        } else {
                            $team->setPoints($team->getPoints() + 1);
                            $em = $this->getDoctrine()->getManager();
                            $em->persist($team);
                            $em->flush();
                        }
                    } else {
                        if ($result->getResultat() == 'Domicile') {
                            $team->setHomeDefeat($team->getHomeDefeat() + 1);
                            $em = $this->getDoctrine()->getManager();
                            $em->persist($team);
                            $em->flush();
                        } else if ($result->getResultat() == 'Exterieur') {
                            $team->setOutsideVictory($team->getOutsideVictory() + 1);
                            $team->setPoints($team->getPoints() + 3);
                            $em = $this->getDoctrine()->getManager();
                            $em->persist($team);
                            $em->flush();
                        } else {
                            $team->setPoints($team->getPoints() + 1);
                            $em = $this->getDoctrine()->getManager();
                            $em->persist($team);
                            $em->flush();
                        }
                    }
                }
            }
        }
        return new Response('');
    }
}
?>