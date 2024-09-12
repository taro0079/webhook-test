<?php

namespace App\Webhook;

use Symfony\Component\HttpFoundation\ChainRequestMatcher;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestMatcher\MethodRequestMatcher;
use Symfony\Component\HttpFoundation\RequestMatcherInterface;
use Symfony\Component\RemoteEvent\RemoteEvent;
use Symfony\Component\Webhook\Client\AbstractRequestParser;

class LoginParser extends AbstractRequestParser
{
    protected function getRequestMatcher(): RequestMatcherInterface
    {
        return new ChainRequestMatcher([
//            new HostRequestMatcher('line.com'),
            // new IsJsonRequestMatcher(),
            new MethodRequestMatcher('GET'),
        ]);
    }

    protected function doParse(Request $request, string $secret): ?RemoteEvent
    {
        // $content = $request->toArray();
        return new RemoteEvent(
            name: 'line/callback',
            id: 1,
            payload: $request->query->all()
        );
    }
}
