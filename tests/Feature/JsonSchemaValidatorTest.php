<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ToolsController;

test('json schema validator page can be rendered', function () {
    $response = $this->get(route('tools.json-schema-validator'));
    $response->assertStatus(200);
});

test('valid json schema returns success', function () {
    $validSchema = [
        '$schema' => 'http://json-schema.org/draft-07/schema#',
        'title' => 'Product',
        'type' => 'object',
        'properties' => [
            'productId' => ['type' => 'integer'],
        ],
        'required' => ['productId'],
    ];

    $response = $this->postJson(route('tools.json-schema-validator'), ['schema' => json_encode($validSchema)]);

    $response->assertStatus(200)
        ->assertJson(['valid' => true]);
});

test('invalid json schema returns error', function () {
    $invalidSchema = [
        '$schema' => 'http://json-schema.org/draft-07/schema#',
        'title' => 'Product',
        'type' => 'object',
        'properties' => [
            'productId' => ['type' => 'integer'],
        ],
        'required' => ['nonExistentField'], // This makes it invalid
    ];

    $response = $this->postJson(route('tools.json-schema-validator'), ['schema' => json_encode($invalidSchema)]);

    $response->assertStatus(200)
        ->assertJson(['valid' => false])
        ->assertJsonStructure(['valid', 'errors' => [['message']]]);
});
