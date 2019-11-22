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
                    'Cristhian V.',
                    'Luis C.',
                    'Marlon M.',
                    'Santiago G.',
                ],
            ],
            [
                'client' => 'Pacasmayo',
                'members' =>
                [
                    'Alex J.',
                    'Eduardo G.',
                    'Jordano M.',
                    'Karla A.',
                    'Mario C.',
                ],
            ],
            [
                'client' => 'Culqi',
                'members' =>
                [
                    'Atilio O.',
                    'Joca P.',
                    'Kerly C.',
                    'Kevin A.',
                    'Willian C.',
                ],
            ],
            [
                'client' => 'DELOSI',
                'members' =>
                [
                    'Christian M.',
                    'Harrison C.',
                    'Renee O.',
                    'Stywar V.',
                    'Yaritza R.',
                ],
            ],
            [
                'client' => 'Mi Banco',
                'members' =>
                [
                    'Maggie E.',
                    'Steven T.',
                ],
            ],
        ];

        $values = $response;
        $this->info('Fetching team members events...');

        event(new MembersFetched($values));

        $this->info('All done!');
    }
}
