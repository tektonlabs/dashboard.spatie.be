<?php

namespace App\Console\Components\Moody;

use Illuminate\Console\Command;
use App\Events\Moody\LastUpdatedRecords;

class FetchLastUpdatedRecords extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dashboard:update-moody';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fecth moody\'s records';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $url = env('MOODY_URL');
        event(new LastUpdatedRecords($url));
    }
}
