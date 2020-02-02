<?php

namespace App\Console;

use Illuminate\Console\Command;

class UpdateDashboardCommand extends Command
{
    protected $signature = 'dashboard:update';

    protected $description = 'Update all components displayed on the dashboard.';

    public function handle()
    {
        $this->call('dashboard:send-heartbeat');
        $this->call('dashboard:determine-appearance');
        $this->call('dashboard:fetch-calendar-events');
        $this->call('dashboard:fetch-timezones');
        $this->call('dashboard:fetch-last-documents');
        $this->call('dashboard:fetch-team-members-from-spreadsheet');
    }
}
