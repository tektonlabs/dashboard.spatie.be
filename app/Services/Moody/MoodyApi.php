<?php

namespace App\Services\Moody;

class MoodyApi
{
    private $base_url = config('moody.api_url');

    public function getDailySummary()
    {

        try {
            $response = json_decode(file_get_contents("{$this->base_url}/api/comments/summary"), true);
            $events = $response['data'] ?? [];
        } catch (\Exception $e) {
            $events = [];
        }

        return collect($events);
    }
}
