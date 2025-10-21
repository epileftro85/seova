<?php

use Illuminate\Support\Facades\Http;

it('fetches metadata from external url and returns JSON', function(){
    Http::fake([
        'https://example.com/*' => Http::response('<html><head><title>Example Domain</title><meta name="description" content="An example description."></head><body></body></html>', 200)
    ]);

    $response = $this->getJson(route('tools.serp.fetch', ['url' => 'https://example.com/page']));
    $response->assertStatus(200)
        ->assertJsonFragment([
            'title' => 'Example Domain',
            'description' => 'An example description.'
        ]);
});

it('handles fetch error gracefully', function(){
    Http::fake([
        'https://bad.example/*' => Http::response('', 500)
    ]);

    $response = $this->getJson(route('tools.serp.fetch', ['url' => 'https://bad.example/page']));
    $response->assertStatus(422)->assertJsonStructure(['error']);
});
