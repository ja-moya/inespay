<?php

declare(strict_types=1);

namespace Amoya\Inespay\PaymentContext\PaymentModule\Infrastructure\Http;

interface HttpPostClientInterface
{
    public function sendJson(string $url, array $headers, array $body): void;
}
