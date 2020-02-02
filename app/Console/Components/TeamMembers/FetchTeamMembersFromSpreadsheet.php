<?php

namespace App\Console\Components\TeamMembers;

use App\Events\TeamMembers\MembersFetched;
use Illuminate\Console\Command;
use Google_Client;
use Google_Service_Sheets;

class FetchTeamMembersFromSpreadsheet extends Command
{
    protected $signature = 'dashboard:fetch-team-members-from-spreadsheet';

    protected $description = 'Fetch events from a Google Calendar';

    public function handle()
    {
        $reader = $this->getSpreadsheetService();
        $spreadsheetId = config('services.team-members.spreadsheet_id');
        $collaborators = collect($reader->spreadsheets_values->get($spreadsheetId, 'Data'));
        $clients = $collaborators->shift();
        $members = collect($clients)->map(function($client) {
            return ['client' => $client];
        })->toArray();
        $collaborators->each(function($row) use(&$members) {
            foreach($row as $index => $value) {
                if($value !== "") {
                    $members[$index]['members'][] = $value;
                }
            }
        });

        $this->info('Fetching team members events...');
        event(new MembersFetched($members));
        $this->info('All done!');
    }

    /**
     * Returns an authorized API client.
     * @return Google_Service_Sheets the authorized client object
     */
    function getSpreadsheetService()
    {
        $client = new Google_Client();
        $client->setApplicationName('Dashboard Spreadsheet Reader');
        $client->setScopes(Google_Service_Sheets::SPREADSHEETS_READONLY);
        $client->setAuthConfig(config('google-calendar.service_account_credentials_json'));
        return new Google_Service_Sheets($client);;
    }
}
