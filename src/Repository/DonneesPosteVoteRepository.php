<?php

namespace App\Repository;

use App\Entity\DonneesPosteVote;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<DonneesPosteVote>
 *
 * @method DonneesPosteVote|null find($id, $lockMode = null, $lockVersion = null)
 * @method DonneesPosteVote|null findOneBy(array $criteria, array $orderBy = null)
 * @method DonneesPosteVote[]    findAll()
 * @method DonneesPosteVote[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DonneesPosteVoteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DonneesPosteVote::class);
    }

    public function save(DonneesPosteVote $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(DonneesPosteVote $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return DonneesPosteVote[] Returns an array of DonneesPosteVote objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('d')
//            ->andWhere('d.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('d.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?DonneesPosteVote
//    {
//        return $this->createQueryBuilder('d')
//            ->andWhere('d.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
