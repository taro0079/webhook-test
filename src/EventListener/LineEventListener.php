<?php

namespace App\EventListener;

use App\Event\LineMessageEvent;
use Psr\Log\LoggerInterface;
use Symfony\Component\EventDispatcher\Attribute\AsEventListener;

#[AsEventListener(event: LineMessageEvent::class, method: 'onMessage')]
class LineEventListener
{

    public function __construct(
        private LoggerInterface $logger,
    )
    {
    }

    public function onMessage(LineMessageEvent $event): void
    {
        $this->logger->info(json_encode($event->getPayload()));

    }
}