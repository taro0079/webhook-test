<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Customer;

interface CustomerRepositoryInterface
{
    public function findOneByLineUserId(string $lineUserId): ?Customer;

    public function save(Customer $customer): void;

    /**
     * @return Customer[]
     */
    public function findAll(): array;
}
