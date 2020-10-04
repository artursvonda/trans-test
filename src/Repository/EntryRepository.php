<?php

namespace App\Repository;

use App\Entity\Entry;
use App\Entity\Translation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Entry|null find($id, $lockMode = null, $lockVersion = null)
 * @method Entry|null findOneBy(array $criteria, array $orderBy = null)
 * @method Entry[]    findAll()
 * @method Entry[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EntryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Entry::class);
    }

    /**
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function save(Entry $entry)
    {
        $entityManager = $this->getEntityManager();

        $entityManager->persist($entry);
        $entityManager->flush();
    }

    public function removeTranslation(Translation $translation)
    {
        $entityManager = $this->getEntityManager();

        $entityManager->remove($translation);
        $entityManager->flush();
    }
}
