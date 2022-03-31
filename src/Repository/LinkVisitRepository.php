<?php

namespace App\Repository;

use App\Entity\LinkVisit;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method LinkVisit|null find($id, $lockMode = null, $lockVersion = null)
 * @method LinkVisit|null findOneBy(array $criteria, array $orderBy = null)
 * @method LinkVisit[]    findAll()
 * @method LinkVisit[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LinkVisitRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, LinkVisit::class);
    }

    /**
     * @throws OptimisticLockException
     */
    public function add(LinkVisit $entity, bool $flush = true): void
    {
        $this->_em->persist($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
     * @throws OptimisticLockException
     */
    public function remove(LinkVisit $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }
}
