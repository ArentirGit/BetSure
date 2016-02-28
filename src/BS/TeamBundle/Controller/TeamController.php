<?php
namespace BS\TeamBundle\Controller;

use BS\TeamBundle\Entity\Team;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use BS\ResultBundle\Repository;
/**
 * Created by PhpStorm.
 * User: Bj�rn
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
            $team->setHomeNull("0");
            $team->setHomeDefeat("0");
            $team->setOutsideVictory("0");
            $team->setOutsideNull("0");
            $team->setOutsideDefeat("0");
            $team->setRank("0");
            $team->setHomeRank("0");
            $team->setOutsideRank("0");
            $team->setPoints("0");
            $team->setHomePoints("0");
            $team->setOutsidePoints("0");
            $team->setSeries("");
            $em = $this->getDoctrine()->getManager();
            $em->persist($team);
            $em->flush();
        }
        return new Response('');
    }

    public function getTeamResultAction(){
        ini_set('max_execution_time', 18000);
        $cpt = 0;
        $teamRepository = $this->getDoctrine()->getManager()->getRepository('BSTeamBundle:Team');
        $marketRepository = $this->getDoctrine()->getManager()->getRepository('BSResultBundle:MarketResult');
            $resultAndMarketList = $marketRepository->getResultJoinMarket();
            $countMarket = $marketRepository->countMarket();
            $nb = $countMarket[0]['nb'];
            foreach($resultAndMarketList as $result){
                    var_dump($cpt. " sur " .$nb."</br>");
                    $teamH = $teamRepository->getTeamByCompetition($result->getResult()->getCompetitionID(), $result->getResult()->getHomeTeamId());
                    if ($result->getResultat() == 'Domicile') {
                        $teamH[0]->setHomePoints($teamH[0]->getHomePoints()+3);
                        $teamH[0]->setHomeVictory($teamH[0]->getHomeVictory() + 1);
                        $teamH[0]->setPoints($teamH[0]->getPoints() + 3);
                        $teamH[0]->setSeries("V".$teamH[0]->getSeries());
                        $em = $this->getDoctrine()->getManager();
                        $em->persist($teamH[0]);
                    }
                    else if ($result->getResultat() == 'Exterieur') {
                        $teamH[0]->setOutsideDefeat($teamH[0]->getOutsideDefeat() + 1);
                        $teamH[0]->setSeries("D".$teamH[0]->getSeries());
                        $em = $this->getDoctrine()->getManager();
                        $em->persist($teamH[0]);
                    }
                    else {
                        $teamH[0]->setHomePoints($teamH[0]->getHomePoints()+1);
                        $teamH[0]->setHomeNull($teamH[0]->getHomeNull()+1);
                        $teamH[0]->setPoints($teamH[0]->getPoints() + 1);
                        $teamH[0]->setSeries("N".$teamH[0]->getSeries());
                        $em = $this->getDoctrine()->getManager();
                        $em->persist($teamH[0]);
                    }

                    $teamO = $teamRepository->getTeamByCompetition($result->getResult()->getCompetitionID(), $result->getResult()->getOutsideTeamId());
                    if ($result->getResultat() == 'Domicile')
                    {
                        $teamO[0]->setHomeDefeat($teamO[0]->getHomeDefeat() + 1);
                        $em = $this->getDoctrine()->getManager();
                        $teamO[0]->setSeries("D".$teamO[0]->getSeries());
                        $em->persist($teamO[0]);
                        }
                    else if ($result->getResultat() == 'Exterieur') {
                        $teamO[0]->setOutsidePoints($teamO[0]->getOutsidePoints()+1);
                        $teamO[0]->setOutsideVictory($teamO[0]->getOutsideVictory() + 1);
                        $teamO[0]->setPoints($teamO[0]->getPoints() + 3);
                        $teamO[0]->setSeries("V".$teamO[0]->getSeries());
                        $em = $this->getDoctrine()->getManager();
                        $em->persist($teamO[0]);
                    }
                    else
                    {
                        $teamO[0]->setOutsidePoints($teamO[0]->getOutsidePoints()+1);
                        $teamO[0]->setOutsideNull($teamO[0]->getOutsideNull()+1);
                        $teamO[0]->setPoints($teamO[0]->getPoints() + 1);
                        $teamO[0]->setSeries("N".$teamO[0]->getSeries());
                        $em = $this->getDoctrine()->getManager();
                        $em->persist($teamO[0]);
                    }
                        $cpt++;
                        //var_dump($teamH[0]->getName() + " : " + $teamH[0]->getId() + " : " + $teamH[0]->getCompetitionId() + "\n" + $result->getResult()->getHomeTeamId() + "\n");
                        //var_dump($teamH[0]->getName() + " : " + $teamH[0]->getId() + " : " + $teamH[0]->getCompetitionId() + "\n" + $result->getResult()->getOutsideTeamId() + "\n");
                        $em->flush();

            }
        return new Response('');
    }

    public function updateRankAction(){
        ini_set('max_execution_time', 18000);
        $teamRepository =$this->getDoctrine()->getManager()->getRepository("BSTeamBundle:Team");

        $competitionList = $teamRepository->getTeamGroupByCompetition();
        foreach($competitionList as $competition){
            $teamList = $teamRepository->getTeam($competition['competitionId']);

            $cpt = 1;
            foreach($teamList as $team){

                $team->setRank($cpt);
                $em = $this->getDoctrine()->getManager();
                $em->persist($team);
                $em->flush();
                var_dump($team);
                $cpt++;
            }

        }

        return new Response('');
    }

    public function updateHomeRankAction(){
        ini_set('max_execution_time', 18000);
        $teamRepository =$this->getDoctrine()->getManager()->getRepository("BSTeamBundle:Team");

        $competitionList = $teamRepository->getTeamGroupByCompetition();
        foreach($competitionList as $competition){
            $teamList = $teamRepository->getHomeTeam($competition['competitionId']);

            $cpt = 1;
            foreach($teamList as $team){

                $team->setHomeRank($cpt);
                $em = $this->getDoctrine()->getManager();
                $em->persist($team);
                $em->flush();
                var_dump($team);
                $cpt++;
            }

        }
        return new Response('');
    }

    public function updateOutsideRankAction(){
        ini_set('max_execution_time', 18000);
        $teamRepository =$this->getDoctrine()->getManager()->getRepository("BSTeamBundle:Team");

        $competitionList = $teamRepository->getTeamGroupByCompetition();
        foreach($competitionList as $competition){
            $teamList = $teamRepository->getOutsideTeam($competition['competitionId']);

            $cpt = 1;
            foreach($teamList as $team){

                $team->setOutsideRank($cpt);
                $em = $this->getDoctrine()->getManager();
                $em->persist($team);
                $em->flush();
                var_dump($team);
                $cpt++;
            }

        }
        return new Response('');
    }
}
?>