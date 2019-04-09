<?php

namespace App\Services\Moody;

class MoodyApi
{
    private $base_url;

    public function getDailySummary()
    {
        $this->base_url = config('moody.api_url');

        try {
            $response = json_decode(file_get_contents("{$this->base_url}/api/comments/summary"), true);
            $summary = $response['data'] ?? [];
        } catch (\Exception $e) {
            $summary = [];
        }

        return collect($summary);
    }
}
