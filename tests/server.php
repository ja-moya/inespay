<?php

declare(strict_types=1);

try {
    $body = json_decode(file_get_contents('php://input'), true, 512, JSON_THROW_ON_ERROR);
    $headers = getallheaders();

    file_put_contents(__DIR__ . '/last_request.json', json_encode([
        'headers' => $headers,
        'body' => $body,
    ], JSON_THROW_ON_ERROR));
} catch (JsonException $e) {
    file_put_contents(__DIR__ . '/last_request_error.log', $e->getMessage());
    http_response_code(400);
    echo 'Invalid JSON';
    exit;
}

http_response_code(200);
echo 'OK';
