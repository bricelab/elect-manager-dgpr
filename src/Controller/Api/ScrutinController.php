<?php

namespace App\Controller\Api;

use App\Entity\DonneesPosteVote;
use App\Entity\SuffragesObtenus;
use App\Entity\Utilisateur;
use App\Repository\CandidatRepository;
use App\Repository\PosteVoteRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api', name: 'app_api_scrutin_')]
class ScrutinController extends AbstractController
{
    #[Route('/remonter-resultats', name: 'remonter_resultats', methods: Request::METHOD_POST)]
    public function remonterResultats(Request $request, PosteVoteRepository $posteVoteRepository, CandidatRepository $candidatRepository, EntityManagerInterface $entityManager): Response
    {
        $user = $this->getUser();

        if (!$user instanceof Utilisateur) {
            throw $this->createAccessDeniedException('Accès refusé');
        }

        $payload = json_decode($request->getContent(), true);
        dump($payload);

        $posteVote = $posteVoteRepository->find($payload['posteVote']);
        if (!$posteVote) {
            throw $this->createNotFoundException('Poste de vote non trouvé');
        }

        if ($posteVote->isEstRemonte()) {
            throw new BadRequestException('Les résultats du poste de vote ont déjà été remontés');
        }

        $inscrits = intval($payload['inscrits']);
        $votants = intval($payload['votants']);
        $nuls = intval($payload['nuls']);
        $suffrages = $payload['suffrages'];

        if (!$inscrits || !$votants || !$nuls || !is_array($suffrages)) {
            throw new BadRequestException('Les résultats sont erronés');
        }

        $candidats = $candidatRepository->findBy([]);
        $total = $nuls;

        foreach ($candidats as $candidat) {
//            $total += $suffrages[sprintf('%s_%s', $candidat->getSigle(), $candidat->getNom())];
            $total += $suffrages[$candidat->getId()];
        }

        if ($votants !== $total) {
            throw new BadRequestException('Les résultats sont erronés');
        }

        $donneesPosteVote = new DonneesPosteVote();
        $donneesPosteVote
            ->setPosteVote($posteVote)
            ->setRemontePar($user)
            ->setNbInscrits($inscrits)
            ->setNbVotants($votants)
            ->setNbBulletinsNuls($nuls)
        ;

        $entityManager->persist($donneesPosteVote);

        foreach ($candidats as $candidat) {
            $voix = new SuffragesObtenus();
            $voix
                ->setPosteVote($posteVote)
                ->setCandidat($candidat)
                ->setNbVoix(
//                    intval($suffrages[sprintf('%s_%s', $candidat->getSigle(), $candidat->getNom())])
                    intval($suffrages[$candidat->getId()])
                )
            ;

            $entityManager->persist($voix);
        }

        $posteVote->setEstRemonte(true);

        $entityManager->flush();

        return $this->json('OK');
    }
}
