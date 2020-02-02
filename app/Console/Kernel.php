<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use App\Console\Components\TeamMembers\FetchTeamMembersPlain;
use App\Console\Components\Help\FetchLastUpdatedDocuments;
use App\Console\Components\Timezone\FetchTimezones;
use App\Console\Components\Dashboard\SendHeartbeatCommand;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Console\Components\Calendar\FetchCalendarEventsCommand;
use App\Console\Components\Dashboard\DetermineAppearanceCommand;
use App\Console\Components\TeamMembers\FetchTeamMembersFromSpreadsheet;

class Kernel extends ConsoleKernel
{

    protected function schedule(Schedule $schedule)
    {
        $schedule->command(FetchTeamMembersFromSpreadsheet::class)->hourly();
        $schedule->command(FetchLastUpdatedDocuments::class)->hourly();
        $schedule->command(FetchCalendarEventsCommand::class)->hourly();
        $schedule->command(SendHeartbeatCommand::class)->everyMinute();
        $schedule->command(DetermineAppearanceCommand::class)->everyMinute();
        $schedule->command(FetchTimezones::class)->everyMinute();
        $schedule->command('websockets:clean')->daily();
    }

    public function commands()
    {
        $commandDirectories = glob(app_path('Console/Components/*'), GLOB_ONLYDIR);
        $commandDirectories[] = app_path('Console');

        collect($commandDirectories)->each(function (string $commandDirectory) {
            $this->load($commandDirectory);
        });
    }
}
