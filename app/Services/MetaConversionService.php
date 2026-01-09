<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class MetaConversionService
{
    protected $pixelId;
    protected $accessToken;
    protected $apiVersion;
    protected $endpoint;
    protected $enabled;

    protected $testEventCode;

    public function __construct()
    {
        $this->pixelId = config('services.meta.pixel_id');
        $this->accessToken = config('services.meta.access_token');
        $this->apiVersion = config('services.meta.api_version', 'v21.0');
        $this->endpoint = config('services.meta.endpoint', 'https://graph.facebook.com');
        $this->testEventCode = config('services.meta.test_event_code');
        
        // Only enable if configured
        $this->enabled = !empty($this->pixelId) && !empty($this->accessToken);
    }

    /**
     * Sends a 'Lead' event to Meta CAPI.
     *
     * @param array $userData User data (name, email, etc.)
     * @param string|null $eventID Deduplication ID from frontend
     * @param string|null $sourceUrl Page URL where event happened
     * @return array
     */
    public function sendLeadEvent(array $userData, ?string $eventID = null, ?string $sourceUrl = null)
    {
        if (!$this->enabled) {
            return ['status' => 'skipped', 'reason' => 'configuration_missing'];
        }

        $eventData = [
            'event_name' => 'Lead',
            'event_time' => time(),
            'action_source' => 'website',
            'event_source_url' => $sourceUrl ?? url()->previous(),
            'user_data' => $this->processUserData($userData),
        ];

        if ($eventID) {
            $eventData['event_id'] = $eventID;
        }

        return $this->sendEvent($eventData);
    }

    /**
     * Sends a raw event payload to Meta.
     */
    protected function sendEvent(array $eventData)
    {
        $url = "{$this->endpoint}/{$this->apiVersion}/{$this->pixelId}/events";
        
        $payload = [
            'data' => [$eventData],
        ];

        if ($this->testEventCode) {
            $payload['test_event_code'] = $this->testEventCode;
        }

        Log::info('[Meta Conversion API] Sending Payload', [
            'url' => $url,
            'test_code' => $this->testEventCode ?? 'NONE',
            'pixel_id' => $this->pixelId,
            'payload' => $payload
        ]);

        try {
            $response = Http::withToken($this->accessToken)
                ->timeout(10)
                ->post($url, $payload);

            if ($response->successful()) {
                Log::info('[Meta Conversion API] Event Sent', [
                    'event' => $eventData['event_name'],
                    'id' => $eventData['event_id'] ?? 'none'
                ]);
                return ['status' => 'success', 'response' => $response->json()];
            } else {
                Log::warning('[Meta Conversion API] API Error', [
                    'status' => $response->status(),
                    'body' => $response->body()
                ]);
                return ['status' => 'error', 'message' => $response->body()];
            }

        } catch (\Exception $e) {
            Log::error('[Meta Conversion API] Exception', ['message' => $e->getMessage()]);
            return ['status' => 'error', 'message' => $e->getMessage()];
        }
    }

    /**
     * Hashes and formats user data according to Meta requirements.
     */
    protected function processUserData(array $data)
    {
        $processed = [];

        // Email (hash)
        if (!empty($data['email'])) {
            $processed['em'] = $this->hash($data['email']);
        }

        // Phone (hash)
        if (!empty($data['phone'])) {
            $processed['ph'] = $this->hash($data['phone']);
        }

        // Name handling
        if (!empty($data['name'])) {
            // Simple split for First/Last if not provided separately
            $parts = explode(' ', trim($data['name']), 2);
            $processed['fn'] = $this->hash($parts[0]);
            if (count($parts) > 1) {
                $processed['ln'] = $this->hash($parts[1]);
            }
        }

        // IP Address (do not hash)
        if (!empty($data['ip'])) {
            $processed['client_ip_address'] = $data['ip'];
        }

        // User Agent (do not hash)
        if (!empty($data['user_agent'])) {
            $processed['client_user_agent'] = $data['user_agent'];
        }

        // External ID (optional, but good for matching)
        // if (!empty($data['external_id'])) {
        //     $processed['external_id'] = $this->hash($data['external_id']);
        // }

        return $processed;
    }

    /**
     * Normalizes and hashes data (SHA-256).
     */
    protected function hash($value)
    {
        return hash('sha256', trim(strtolower($value)));
    }
}
