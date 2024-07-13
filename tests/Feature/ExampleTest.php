<?php

declare(strict_types=1);

$localApp = require_once ROOT_DIR . '/bootstrap/app.php';

beforeEach(function () use ($localApp) {
    $this->app = $localApp;
});

test('GET home route is ok', function () {
    $response = $this->get('/');

    $responseData = json_decode((string) $response->getBody(), true);

    expect($response->getStatusCode())->toBe(200)
        ->and($responseData)->toBeArray()
        ->and($responseData)->toHaveKeys(['data'])
        ->and($responseData['data']['version'])->toBe(1);
});

test('GET order detail is ok', function () {
    $response = $this->get('/333');

    $responseData = json_decode((string) $response->getBody(), true);

    expect($response->getStatusCode())->toBe(200)
        ->and($responseData)->toBeArray()
        ->and($responseData)->toHaveKeys(['data'])
        ->and($responseData['data'][0])->toHaveKeys(['id', 'name', 'sum', 'createdAt', 'items']);
});
