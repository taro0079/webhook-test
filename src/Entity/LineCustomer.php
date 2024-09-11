<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'line_customer')]
class LineCustomer
{
    #[ORM\Id]
    #[ORM\Column]
    private string $lineUserId;

    #[ORM\Embedded(class: Nonce::class)]
    private Nonce $nonce;

    #[ORM\ManyToOne(targetEntity: Customer::class, inversedBy: 'lineCustomers')]
    #[ORM\JoinColumn(name: 'customer_id', referencedColumnName: 'customer_id')]
    private Customer $customer;

    public function __construct(
        string $lineUserId,
        Customer $customer
    ) {
        $this->lineUserId = $lineUserId;
        $this->customer = $customer;
        $this->nonce = new Nonce();
    }

    public function getLineUserId(): string
    {
        return $this->lineUserId;
    }

    public function getCustomer(): Customer
    {
        return $this->customer;
    }

    public function getNonce(): Nonce
    {
        return $this->nonce;
    }
}
