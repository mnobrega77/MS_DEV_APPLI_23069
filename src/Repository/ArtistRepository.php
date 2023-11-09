<?php

namespace App\Repository;

use App\Entity\Artist;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Artist>
 *
 * @method Artist|null find($id, $lockMode = null, $lockVersion = null)
 * @method Artist|null findOneBy(array $criteria, array $orderBy = null)
 * @method Artist[]    findAll()
 * @method Artist[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArtistRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Artist::class);
    }

    public function save(Artist $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Artist $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }



//    /**
//     * @return Artist[] Returns an array of Artist objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('a.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Artist
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }

//QueryBuilder query
//    public function getSomeArtists($name)
//    {
////        $name = "Neil";
//
//        $qb = $this->createQueryBuilder('a');
//        $qb
//            ->andWhere('a.name like :name') //le `placeholder comme en PDO!
//            ->setParameter('name', '%'.$name.'%')
//            ->orderBy('a.id', 'ASC')
//            ->setMaxResults(10);
//
//        $artists = $qb->getQuery()->getResult();
//        return $artists;
//    }

    //DQL query
    public function getSomeArtists($name)
    {
//        $name = "Neil";
        $entityManager = $this->getEntityManager(); //on instancie l'entity manager

        $query = $entityManager->createQuery( //on crée la requête
            'SELECT a
        FROM App\Entity\Artist a
        WHERE a.name  like :name'
        )->setParameter('name', '%'.$name.'%');

        // retourne un tableau d'objets de type Artist
        return $query->getResult();

    }

}
