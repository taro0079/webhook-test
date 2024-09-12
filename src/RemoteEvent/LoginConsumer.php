<?php

namespace App\RemoteEvent;

use Psr\Log\LoggerInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\RemoteEvent\Attribute\AsRemoteEventConsumer;
use Symfony\Component\RemoteEvent\Consumer\ConsumerInterface;
use Symfony\Component\RemoteEvent\RemoteEvent;

#[AsRemoteEventConsumer(name: 'line/callback')]
class LoginConsumer implements ConsumerInterface
{
    public function __construct(
        private LoggerInterface $logger,
        private EventDispatcherInterface $dispatcher,
    ) {

    }

    public function consume(RemoteEvent $event): void
    {
        $this->logger->info(json_encode($event->getPayload()));

    }
}
