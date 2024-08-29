<?php

namespace App\Event;

use Symfony\Contracts\EventDispatcher\Event;

class LineMessageEvent extends Event
{

    public function __construct(
        private array $event
    )
    {
    }

    public function getEvent(): array
    {
        return $this->event;
    }


}