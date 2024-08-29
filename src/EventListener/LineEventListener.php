<?php

namespace App\EventListener;

use App\Event\LineMessageEvent;
use App\Services\LineService;
use Psr\Log\LoggerInterface;
use Symfony\Component\EventDispatcher\Attribute\AsEventListener;

#[AsEventListener(event: LineMessageEvent::class, method: 'onMessage')]
class LineEventListener
{

    public function __construct(
        private LoggerInterface $logger,
        private LineService $lineService,
    )
    {
    }

    public function onMessage(LineMessageEvent $event): void
    {
        $replyToken = $event->getEvent()['replyToken'];


         $this->lineService->sendMessage('webhookのテストです。', $replyToken);

    }
}