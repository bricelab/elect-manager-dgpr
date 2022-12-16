<?php

namespace App\Controller\Api;

use App\Entity\Utilisateur;
use App\Repository\CandidatRepository;
use App\Repository\CentreVoteRepository;
use App\Repository\IncidentSignaleRepository;
use App\Repository\PosteVoteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Finder\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api', name: 'app_api_user_')]
class UtilisateurController extends AbstractController
{
    #[Route('/me', name: 'me', methods: Request::METHOD_GET)]
    public function me(
        PosteVoteRepository $posteVoteRepository,
        IncidentSignaleRepository $incidentSignaleRepository,
        CentreVoteRepository $centreVoteRepository,
        CandidatRepository $candidatRepository,
    ): Response {
        $user = $this->getUser();

        if (!$user instanceof Utilisateur) {
            throw new AccessDeniedException('Accès refusé');
        }

        return $this->json(
            [
                'user' => $user,
//                'postesTotal' => $posteVoteRepository->countByArrondissement($user->getArrondissementCouvert()),
//                'postesRemontes' => $posteVoteRepository->countByArrondissementAndByRemonteStatus($user->getArrondissementCouvert()),
                'incidentsSignales' => $incidentSignaleRepository->count([
                    'signalePar' => $user,
                    'arrondissement' => $user->getArrondissementCouvert()
                ]),
                'centresVote' => $centreVoteRepository->findByArrondissement($user->getArrondissementCouvert()),
                'postesVote' => $posteVoteRepository->findByArrondissement($user->getArrondissementCouvert()),
                'candidats' => $candidatRepository->findBy([]),
            ],
            Response::HTTP_OK,
            [],
            ['groups' => ['read:Item:Me']]
        );
    }
}
