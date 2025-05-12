<?php

declare(strict_types=1);

namespace Amoya\Inespay\PaymentContext\PaymentModule\Infrastructure\Http;

use Amoya\Inespay\PaymentContext\PaymentModule\Domain\Entity\Payment;
use Amoya\Inespay\PaymentContext\PaymentModule\Domain\Service\NotificationServiceInterface;
use Firebase\JWT\JWT;

final readonly class HttpNotificationService implements NotificationServiceInterface
{
    public function __construct(
        private string $endpoint,
        private string $jwtSecret,
        private HttpPostClientInterface $httpClient
    ) {
    }

    public function send(Payment $payment): void
    {
        $payload = $this->getPayloadToSend($payment);

        $headers = $this->getHeadersToSend($payload);

        $this->httpClient->sendJson(
            $this->endpoint,
            $headers,
            $payload);
    }

    private function getPayloadToSend(Payment $payment): array
    {
        return [
            'amount' => $payment->amount()->value(),
            'status' => $payment->status()->value,
            'creditor_account' => $payment->creditorAccount()->value(),
            'debtor_account' => $payment->debtorAccount()->value(),
            'notification_id' => $payment->notificationId()->value(),
        ];
    }

    private function getHeadersToSend(array $payload): array
    {
        $jsonPayload = json_encode($payload, JSON_THROW_ON_ERROR);
        $signature = JWT::encode(['body' => $jsonPayload], $this->jwtSecret, 'HS256');

        return [
            'Content-Type' => 'application/json',
            'Signature' => $signature,
        ];
    }
}
