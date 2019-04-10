<?php

namespace App\Events\Moody;

use App\Events\DashboardEvent;

class LastUpdatedRecords extends DashboardEvent
{
    public $summary;

    public function __construct($summary)
    {
        $this->summary = $summary;
    }
}
