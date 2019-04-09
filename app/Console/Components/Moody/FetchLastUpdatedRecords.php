<?php

namespace App\Console\Components\Moody;

use Illuminate\Console\Command;
use Carbon\Carbon;
use App\Services\Moody\MoodyApi;
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

    public function handle(MoodyApi $moody)
    {
        $summary = $moody->getDailySummary();
        event(new LastUpdatedRecords($summary));
    }
}