<?php

namespace App\Console\Components\TeamMembers;

use App\Events\TeamMembers\MembersFetched;
use Illuminate\Console\Command;

class FetchTeamMembersPlain extends Command
{
    protected $signature = 'dashboard:fetch-team-members-plain';

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
                    'Juanjo R.',
                    'Karla A.',
                    'Willian C.',
                ],
            ],
            [
                'client' => 'DELOSI',
                'members' =>
                [
                    'Christian M.',
                    'Stywar V.',
                    'Renee O.',
                    'Yaritza R.',
                ],
            ],
        ];

        $values = $response;
        $this->info('Fetching team members events...');
        event(new MembersFetched($values));

        $this->info('All done!');
    }
}
