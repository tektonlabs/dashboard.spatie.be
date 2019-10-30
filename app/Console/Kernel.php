<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use App\Console\Components\Moody\FetchLastUpdatedRecords;
use App\Console\Components\Help\FetchLastUpdatedDocuments;
use App\Console\Components\Timezone\FetchTimezones;
use App\Console\Components\Trains\FetchTrainsCommand;
use App\Console\Components\TeamMember\FetchTasksCommand;
use App\Console\Components\TeamMember\FetchStatusCommand;
use App\Console\Components\Velo\FetchVeloStationsCommand;
use App\Console\Components\Dashboard\SendHeartbeatCommand;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Console\Components\Calendar\FetchCalendarEventsCommand;
use App\Console\Components\Statistics\FetchGitHubTotalsCommand;
use App\Console\Components\Dashboard\DetermineAppearanceCommand;
use App\Console\Components\TeamMember\FetchCurrentTracksCommand;
use App\Console\Components\Statistics\FetchPackagistTotalsCommand;
use App\Console\Components\Buienradar\FetchBuienradarForecastsCommand;

class Kernel extends ConsoleKernel
{

    protected function schedule(Schedule $schedule)
    {
        $schedule->command(FetchLastUpdatedRecords::class)->everyMinute();
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
