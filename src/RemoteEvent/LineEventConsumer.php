<?php

namespace App\RemoteEvent;

use App\Event\LineMessageEvent;
use Psr\Log\LoggerInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\RemoteEvent\Attribute\AsRemoteEventConsumer;
use Symfony\Component\RemoteEvent\Consumer\ConsumerInterface;
use Symfony\Component\RemoteEvent\RemoteEvent;

#[AsRemoteEventConsumer(name: 'line')]
class LineEventConsumer implements ConsumerInterface
{
    public function __construct(
        private LoggerInterface $logger,
        private EventDispatcherInterface $dispatcher,

    )
    {

    }

    public function consume(RemoteEvent $event): void
    {
        $payload = $event->getPayload();
//        $this->logger->info(json_encode($payload));
        $events = $payload['events'];
        $eventClasses = [];
        foreach ($events as $event) {
            if ($event['type'] === 'message') {
                $eventClasses[] = new LineMessageEvent($payload);
            }
        }

        foreach ($eventClasses as $eventClass) {
            $this->dispatcher->dispatch($eventClass);
        }


    }
}
