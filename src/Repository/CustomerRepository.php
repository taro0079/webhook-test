<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Customer;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

final class CustomerRepository extends ServiceEntityRepository implements CustomerRepositoryInterface
{
    private const ALIAS = 'customer';
    private const JOIN_LINE_CUSTOMER_ALIAS = 'line_customer';
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Customer::class);
    }

    public function findOneByLineUserId(string $lineUserId): ?Customer
    {
        return $this->createQueryBuilder(self::ALIAS)
            ->innerJoin(sprintf('%s.lineCustomers', self::ALIAS), self::JOIN_LINE_CUSTOMER_ALIAS)
            ->andWhere(sprintf('%s.lineUserId = :lineUserId', self::JOIN_LINE_CUSTOMER_ALIAS))
            ->setParameter('lineUserId', $lineUserId)
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function save(Customer $customer): void
    {
        $this->getEntityManager()->persist($customer);
        $this->getEntityManager()->flush();
    }

    public function findAll(): array
    {
        return $this->createQueryBuilder(self::ALIAS)
            ->getQuery()
            ->getResult();
    }
}
