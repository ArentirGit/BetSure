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
        $repositoryResult = $this->getDoctrine()->getManager()->getRepository('BSResultBundle:Result');
        $labelResultList = $repositoryResult->getLabelResult();
        //getting the title of a match
        $repositoryTeam = $this->getDoctrine()->getManager()->getRepository('BSTeamBundle:Team');
        foreach ($labelResultList as $labelResult) {
            List($dom, $ext) = explode("-", $labelResult['eventLabel']);
            // parsing of team name with match title
            $teamList = $repositoryTeam->verifyDuplicate($dom);
            //verify if a home playing team is already present in the Team table
            if(empty($teamList)){
                $team = new Team();
                $team->setName($dom);
                $em = $this->getDoctrine()->getManager();
                $em->persist($team);
                $em->flush();
                // add in the Team table the home team
            }
            $teamList = $repositoryTeam->verifyDuplicate($ext);
            if(empty($teamList)){
                $team = new Team();
                $team->setName($ext);
                $em = $this->getDoctrine()->getManager();
                $em->persist($team);
                $em->flush();
            }
        }
        return new Response('');
    }
}
?>