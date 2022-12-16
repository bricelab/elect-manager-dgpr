<?php

namespace App\Controller\Api;

use App\Entity\CentreVote;
use App\Entity\Utilisateur;
use App\Repository\CentreVoteRepository;
use App\Repository\PosteVoteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Finder\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api', name: 'app_api_scrutin_')]
class ScrutinController extends AbstractController
{
    #[Route('/centres-vote/list', name: 'centre_vote_par_arrondissement', methods: Request::METHOD_GET)]
    public function centreVotes(CentreVoteRepository $centreVoteRepository): Response
    {
        $user = $this->getUser();

        if (!$user instanceof Utilisateur) {
            throw new AccessDeniedException('Accès refusé');
        }

        return $this->json(
            $centreVoteRepository->findByArrondissement($user->getArrondissementCouvert()),
            Response::HTTP_OK,
            [],
            ['groups' => ['read:Item:CentreVote']]
        );
    }

    #[Route('/postes-vote/{centreVote}/list', name: 'centre_vote_par_arrondissement', methods: Request::METHOD_GET)]
    public function me(CentreVote $centreVote, PosteVoteRepository $posteVoteRepository): Response
    {
        $user = $this->getUser();

        if (!$user instanceof Utilisateur) {
            throw new AccessDeniedException('Accès refusé');
        }

        if ($user->getArrondissementCouvert() !== $centreVote->getVillageQuartier()->getArrondissement()) {
            throw new AccessDeniedException('Accès refusé');
        }

        return $this->json(
            $posteVoteRepository->findBy(['centreVote' => $centreVote]),
            Response::HTTP_OK,
            [],
            ['groups' => ['read:Item:PosteVote']]
        );
    }
}
