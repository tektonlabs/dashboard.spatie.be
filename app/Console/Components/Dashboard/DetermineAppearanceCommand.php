<?php

namespace App\Console\Components\Dashboard;

use Carbon\Carbon;
use Illuminate\Console\Command;
use App\Events\Dashboard\UpdateAppearance;

class DetermineAppearanceCommand extends Command
{
    protected $signature = 'dashboard:determine-appearance';

    protected $description = 'Determine the looks of the dashboard';

    /** @var float */
    protected $limaLat = -12.0464;

    /** @var float */
    protected $limaLng = -77.0428;

    public function handle()
    {
        $this->info('Determining dashboard appearance...');

        $appearance = $this->sunIsUp()
            ? 'light-mode'
            : 'dark-mode';

        event(new UpdateAppearance($appearance));

        $this->info('All done!');
    }

    public function sunIsUp(): bool
    {
        $sunriseTimestamp = date_sunrise(
            now()->timestamp,
            SUNFUNCS_RET_TIMESTAMP,
            $this->limaLat,
            $this->limaLng
        );
        $sunrise = Carbon::createFromTimestamp($sunriseTimestamp);

        $sunsetTimestamp = date_sunset(
            now()->timestamp,
            SUNFUNCS_RET_TIMESTAMP,
            $this->limaLat,
            $this->limaLng
        );
        $sunset = Carbon::createFromTimestamp($sunsetTimestamp);

        return now()->between($sunrise, $sunset);
    }
}
