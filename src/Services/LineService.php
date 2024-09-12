<?php

namespace App\Services;

use GuzzleHttp\ClientInterface;
use LINE\Clients\MessagingApi\Api\MessagingApiApi;
use LINE\Clients\MessagingApi\Configuration;
use LINE\Clients\MessagingApi\Model\ReplyMessageRequest;
use LINE\Clients\MessagingApi\Model\TextMessage;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpKernel\Log\Logger;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class LineService
{
    private MessagingApiApi $messagingApi;
    public function __construct(
        private ClientInterface $httpClient,
        private Configuration $config,
        private LoggerInterface $logger
    ) {
        $this->messagingApi = new MessagingApiApi(
            client: $this->httpClient,
            config: $this->config
        );
    }

    public function sendMessage(string $messageBody, string $replyToken): void
    {
        $textMessage = new TextMessage(['type' => 'text', 'text' => $messageBody]);
        $request = new ReplyMessageRequest([
            'replyToken' => $replyToken,
            'messages' => [$textMessage],
        ]);
        $response = $this->messagingApi->replyMessage($request);
        $this->logger->info($response);
    }


}

