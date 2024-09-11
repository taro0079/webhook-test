<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'customer')]
class Customer
{
    #[ORM\OneToMany(targetEntity: LineCustomer::class, mappedBy: 'customer', cascade: ['persist'])]
    private Collection $lineCustomers;

    public function __construct(
        #[ORM\Id]
        #[ORM\GeneratedValue]
        #[ORM\Column]
        private ?int $customerId,
        #[ORM\Column]
        private string $name,
    ) {
        $this->lineCustomers = new ArrayCollection();
    }

    public function getCustomerId(): ?int
    {
        return $this->customerId;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getLineCustomers(): Collection
    {
        return $this->lineCustomers;
    }

    public function addLineCustomer(LineCustomer $lineCustomer): void
    {
        $this->lineCustomers->add($lineCustomer);
    }
}
