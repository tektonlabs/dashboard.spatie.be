<?php

namespace App\Events\Timezone;

use App\Events\DashboardEvent;

class TimezonesFetched extends DashboardEvent
{
    public $cities;

    public function __construct($cities)
    {
        $this->cities = $cities;
    }
}
