<?php

declare(strict_types=1);

namespace App\Controller;

class CustomerDto
{
    public function __construct(
        public readonly int $customerId,
        public readonly string $name,
        public readonly string $lineUserId,
    ) {
    }
}
