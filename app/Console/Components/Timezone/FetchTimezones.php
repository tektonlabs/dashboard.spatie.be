<?php

namespace App\Console\Components\Timezone;

use Illuminate\Console\Command;
use App\Events\Timezone\TimezonesFetched;

class FetchTimezones extends Command
{
    protected $signature = 'dashboard:fetch-timezones';

    protected $description = 'Fetch Timezones';

    public function handle()
    {
        $timezonesList =  config('timezones.cities');
        event(new TimezonesFetched($timezonesList));
    }
}
