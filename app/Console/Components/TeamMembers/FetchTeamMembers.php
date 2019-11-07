<?php

namespace App\Console\Components\TeamMembers;

use App\Events\TeamMembers\MembersFetched;
use Illuminate\Console\Command;
use Google_Client;
use Google_Service_Sheets;
use Google_Service_Drive;

class FetchTeamMembers extends Command
{
    protected $signature = 'dashboard:fetch-team-members';

    protected $description = 'Fetch events from a Google Calendar';

    public function handle()
    {
        $response = [
            [
                'client' => 'Pandero',
                'members' =>
                [
                    'Cristhian',
                    'Luis',
                    'Marlon',
                    'Santiago',
                ],
            ],
            [
                'client' => 'Pacasmayo',
                'members' =>
                [
                    'Alex',
                    'Eduardo',
                    'Jordano',
                    'Mario',
                ],
            ],
            [
                'client' => 'Culqi',
                'members' =>
                [
                    'Atilio',
                    'Joca',
                    'Karla',
                    'Kevin',
                    'William',
                ],
            ],
            [
                'client' => 'DELOSI',
                'members' =>
                [
                    'Kerly',
                    'Renee',
                    'Stywar',
                    'Harrison',
                ],
            ],
            [
                'client' => 'Mi Banco',
                'members' =>
                [
                    'Steven',
                    'Maggie',
                ],
            ],
        ];

        $values = $response;
        $this->info('Fetching team members events...');

        event(new MembersFetched($values));

        $this->info('All done!');
    }
}
