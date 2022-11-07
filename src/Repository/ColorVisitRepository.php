<?php

namespace App\Repository;

use App\Entity\ColorVisit;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ColorVisit|null find($id, $lockMode = null, $lockVersion = null)
 * @method ColorVisit|null findOneBy(array $criteria, array $orderBy = null)
 * @method ColorVisit[]    findAll()
 * @method ColorVisit[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ColorVisitRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ColorVisit::class);
    }

    public function add(ColorVisit $entity, bool $flush = true): void
    {
        $this->_em->persist($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    public function remove(ColorVisit $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }
}
