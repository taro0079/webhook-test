<?php

namespace App\Event;

use Symfony\Contracts\EventDispatcher\Event;

class LineMessageEvent extends Event
{

    public function __construct(
        private array $payload
    )
    {
    }

    public function getPayload(): array
    {
        return $this->payload;
    }


}