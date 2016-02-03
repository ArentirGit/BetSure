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
            $teamList = $repositoryTeam->verifyDuplicate($dom);
            //verify if a home playing team is already present in the Team table
            if(empty($teamList)){
                $team = new Team();
                $team->setName($dom);
                $team->setCompetitionId($Result->getCompetitionID());
                var_dump($Result->getCompetitionID());
                $em = $this->getDoctrine()->getManager();
                $em->persist($team);
                $em->flush();
                // add in the Team table the home team
            }
            $teamList = $repositoryTeam->verifyDuplicate($ext);
            if(empty($teamList)){
                $team = new Team();
                $team->setName($ext);
                $team->setCompetitionId($Result->getCompetitionID());
                $em = $this->getDoctrine()->getManager();
                $em->persist($team);
                $em->flush();
            }
            var_dump($Result);
            $teamHome = $repositoryTeam->verifyDuplicate($dom);
            $teamOutside = $repositoryTeam->verifyDuplicate($ext);
            $Result->setHomeTeamId($teamHome[0]->getId());
            $Result->setOutsideTeamId($teamOutside[0]->getId());
            $em = $this->getDoctrine()->getManager();
            $em->persist($Result);
            $em->flush();
        }
        return new Response('');
    }
}
?>