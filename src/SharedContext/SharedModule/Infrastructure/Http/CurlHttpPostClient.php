<?php

declare(strict_types=1);

namespace Amoya\Inespay\SharedContext\SharedModule\Infrastructure\Http;

use Amoya\Inespay\PaymentContext\PaymentModule\Infrastructure\Http\HttpPostClientInterface;
use Amoya\Inespay\SharedContext\SharedModule\Infrastructure\Http\Exception\HttpPostClientException;

/** @codeCoverageIgnore */
class CurlHttpPostClient implements HttpPostClientInterface
{
    public function sendJson(string $url, array $headers, array $body): void
    {
        $ch = curl_init($url);

        $jsonBody = json_encode($body, JSON_THROW_ON_ERROR);

        curl_setopt_array($ch, [
            CURLOPT_POST => true,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => $this->formatHeaders($headers),
            CURLOPT_POSTFIELDS => $jsonBody,
        ]);

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        if (curl_errno($ch)) {
            throw HttpPostClientException::transportError(curl_error($ch));
        }

        curl_close($ch);

        if ($httpCode >= 400) {
            throw HttpPostClientException::failedRequest($httpCode, $response);
        }
    }

    private function formatHeaders(array $headers): array
    {
        $result = [];
        foreach ($headers as $key => $value) {
            $result[] = "$key: $value";
        }
        return $result;
    }
}
