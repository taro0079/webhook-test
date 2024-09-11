<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Embeddable]
class Nonce
{
    #[ORM\Column(type: Types::STRING)]
    private string $nonce;

    public function __construct(
    ) {
        $this->nonce = $this->generateNonce();
    }

    private function generateNonce(): string
    {
        return base64_encode(random_bytes(16));
    }


    public function getNonce(): string
    {
        return $this->nonce;
    }


}
