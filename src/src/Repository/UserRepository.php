<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<User>
 */
class UserRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    public function save(User $user, bool $flush = true): void
    {
        $this->getEntityManager()->persist($user);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function delete(User $user, bool $flush = true): void
    {
        $this->getEntityManager()->remove($user);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function flush(): void
    {
        $this->getEntityManager()->flush();
    }

    /**
     * Busca usuarios por nombre o apellido (insensible a mayúsculas y parcial).
     */
    public function searchByNameOrSurname(string $searchTerm): array
    {
        return $this->createQueryBuilder('u')
            ->andWhere('LOWER(u.name) LIKE LOWER(:term) OR LOWER(u.surname) LIKE LOWER(:term)')
            ->setParameter('term', '%' . $searchTerm . '%')
            ->orderBy('u.surname', 'ASC')
            ->getQuery()
            ->getResult();
    }
}
