<?php

namespace App\Entity;

use App\Repository\OrderRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OrderRepository::class)]
#[ORM\Table(name: '`order`')]
class Order
{
    public function __construct(
        #[ORM\Id]
        #[ORM\GeneratedValue]
        #[ORM\Column]
        private ?int $orderId,
        #[ORM\Column]
        private int $paymentTotal,
    ) {
    }

    public function getOrderId(): ?int
    {
        return $this->orderId;
    }

    public function getPaymentTotal(): int
    {
        return $this->paymentTotal;
    }

}
