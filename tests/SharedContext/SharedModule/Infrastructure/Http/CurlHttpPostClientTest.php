<?php

declare(strict_types=1);

namespace Tests\SharedContext\SharedModule\Infrastructure\Http;

use Amoya\Inespay\SharedContext\SharedModule\Infrastructure\Http\CurlHttpPostClient;
use Amoya\Inespay\SharedContext\SharedModule\Infrastructure\Http\Exception\HttpPostClientException;
use PHPUnit\Framework\TestCase;

/**
 * @group integration
 */
final class CurlHttpPostClientTest extends TestCase
{
    private string $url;

    protected function setUp(): void
    {
        // Asegúrate de que este endpoint está levantado con: php -S localhost:8081 tests/server.php
        $this->url = 'http://localhost:8081';
    }

    public function test_it_sends_json_payload_successfully(): void
    {
        $client = new CurlHttpPostClient();

        $body = [
            'amount' => 123.45,
            'status' => 'COMPLETED',
            'creditor_account' => 'ES1111222233334444',
            'debtor_account' => 'ES5555666677778888',
            'notification_id' => 'f3a9e2f2-4f6e-4e9c-bdcc-1e9aee7d2b2c'
        ];

        $headers = [
            'Content-Type' => 'application/json',
            'Signature' => 'fake-jwt-signature'
        ];

        $client->sendJson($this->url, $headers, $body);

        $path = __DIR__ . '/../../../../last_request.json';

        $this->assertFileExists($path, 'El servidor de test no generó el archivo de respuesta.');

        $data = json_decode(file_get_contents($path), true, 512, JSON_THROW_ON_ERROR);

        $this->assertSame($headers['Content-Type'], $data['headers']['Content-Type']);
        $this->assertSame($headers['Signature'], $data['headers']['Signature']);
        $this->assertSame($body, $data['body']);
    }

    public function test_it_throws_exception_on_error_response(): void
    {
        $this->expectException(HttpPostClientException::class);

        $client = new CurlHttpPostClient();
        $client->sendJson('http://localhost:9999/invalid-endpoint', [], []);
    }
}
