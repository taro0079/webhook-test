<?php

namespace App\EventListener;

use App\Entity\Customer;
use App\Entity\LineCustomer;
use App\Event\LineMessageEvent;
use App\Repository\CustomerRepositoryInterface;
use App\Services\LineConfig;
use App\Services\LineService;
use Psr\Log\LoggerInterface;
use Symfony\Component\EventDispatcher\Attribute\AsEventListener;

#[AsEventListener(event: LineMessageEvent::class, method: 'onMessage')]
class LineEventListener
{
    public function __construct(
        private LoggerInterface $logger,
        private LineService $lineService,
        private CustomerRepositoryInterface $customerRepository,
        private LineConfig $lineConfig
    ) {
    }

    public function onMessage(LineMessageEvent $event): void
    {
        $replyToken = $event->getEvent()['replyToken'];
        $lineUserId = $event->getEvent()['source']['userId'];
        $customer = $this->customerRepository->findOneByLineUserId($lineUserId);
        if (null===$customer) {
            $customer = new Customer(customerId: null, name: 'test');
            $lineUser = new LineCustomer(lineUserId: $lineUserId, customer: $customer);
            $customer->addLineCustomer($lineUser);
        }
        $this->customerRepository->save($customer);
        $this->logger->info(json_encode($event->getEvent()));


        // $this->lineService->sendMessage('webhookのテストです。', $replyToken);
        $this->lineService->sendMessage($this->lineConfig->getAuthorizationUrl(), $replyToken);

    }
}
