<?php

namespace App\Repository;

use App\Entity\PlageHoraire;
use App\Entity\PlanningType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<PlageHoraire>
 *
 * @method PlageHoraire|null find($id, $lockMode = null, $lockVersion = null)
 * @method PlageHoraire|null findOneBy(array $criteria, array $orderBy = null)
 * @method PlageHoraire[]    findAll()
 * @method PlageHoraire[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PlageHoraireRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PlageHoraire::class);
    }

    public function save(PlageHoraire $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(PlageHoraire $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
    public function findByPlanningTypes(PlanningType $planningType): ?PlageHoraire
    {
        // Créer une instance de QueryBuilder pour construire la requête SQL
        $qb = $this->createQueryBuilder('e')

            // Joindre la table PlanningType en utilisant l'alias 'pt'
            ->join('e.planningTypes', 'pt')

            // Ajouter une condition à la requête qui filtre les résultats en fonction de l'identifiant du planning Type
            ->andWhere('pt.id = :planningTypeId')
            ->setParameter('planningTypeId', $planningType->getId());

        // Récupérer le résultat de la requête en appelant getQuery() sur l'objet QueryBuilder et getOneOrNullResult() pour récupérer un seul objet ou null
        return $qb->getQuery()->getOneOrNullResult();
    }
//    /**
//     * @return PlageHoraire[] Returns an array of PlageHoraire objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('p.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?PlageHoraire
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
