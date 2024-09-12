<?php

declare(strict_types=1);

namespace App\Services;

class LineConfig
{
    private const AUTHORIZATION_URL = 'https://access.line.me/oauth2/v2.1/authorize/';
    public function __construct(
        private string $clientId,
        private string $loginCallbackUrl
    ) {
    }

    public function getAuthorizationUrl(): string
    {
        $responseType = 'code';
        $callbackUrl = urlencode($this->loginCallbackUrl);
        $state = uniqid();
        $scope = 'profile%20openid';
        $queryParameters = sprintf(
            '?response_type=%s&client_id=%s&redirect_uri=%s&state=%s&scope=%s',
            $responseType,
            $this->clientId,
            $callbackUrl,
            $state,
            $scope
        );
        return self::AUTHORIZATION_URL . $queryParameters;
    }

}
