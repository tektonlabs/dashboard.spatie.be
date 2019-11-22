<?php

namespace App\Console\Components\TeamMembers;

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
        // dd(json_decode(file_get_contents(config('google-calendar.service_account_credentials_json'))));
        // $config = json_decode(file_get_contents(config('google-calendar.service_account_credentials_json')));

        $client = $this->getClient();
        $service = new Google_Service_Sheets($client);
        $spreadsheetId = '1jKl8hpx-lAx48qDNcAuIIGZCfufkhkNQU64A3MITw0Y';
        $range = 'Sheet1!A2:B1000';
        $queryParameters = [
            'majorDimension' => 'COLUMNS',
        ];
        $response = $service->spreadsheets_values->get($spreadsheetId, $range);
        // $values = $response;
        // $this->info('Fetching team members events...');
        dd($response);

        // $calendarId = $calendarId ?? config('google-calendar.calendar_id');
        // $calendarService = GoogleCalendarFactory::createForCalendarId($calendarId)->getService();
        // $now = Carbon::now();
        // $startDate = $now->startOfMonth();
        // $endDate = $now->endOfMonth();


        // foreach ($calendarService->calendarList->listCalendarList(['minAccessRole' => 'owner']) as $calendarListItem) {
        //     $calendarId = $calendarListItem->getId();

        //     $allEvents = collect(Event::get($startDate, $endDate, $queryParameters, $calendarId))
        //         ->map(function (GoogleCalendarEvent $event) {
        //             $sortDate = $event->getSortDate();
        //             $date =  $event->start->date
        //                 ? Carbon::createFromFormat('Y-m-d', $event->start->date)
        //                 : Carbon::parse($event->start->dateTime);

        //             $attendees = collect($event->attendees)->map(function($element) {
        //                 $username = explode('@', $element->email);

        //                 return [
        //                     'name' => ucwords((implode(' ', explode('.', $username[0]))))
        //                 ];
        //             });

        //             return [
        //                 'attendees' => $attendees,
        //                 'description' => $event->description,
        //                 'date' => $date->format('Y-m-d'),
        //                 'name' => $event->name,
        //             ];
        //         })
        //         ->toArray();

        //     $events[$calendarListItem->getSummary()] = [
        //         'calendarName' => $calendarListItem->getSummary(),
        //         'events' => $allEvents,
        //     ];
        // }

        // event(new EventsFetched($events));

        $this->info('All done!');
    }

    /**
     * Returns an authorized API client.
     * @return Google_Client the authorized client object
     */
    function getClient()
    {
        $client = new Google_Client();

        $client->setApplicationName('Google Sheets API PHP Quickstart');
        $client->setScopes(Google_Service_Sheets::SPREADSHEETS_READONLY);
        $client->setAuthConfig(config('google-calendar.service_account_credentials_json'));

        $client->setAccessType('offline');
        $client->setPrompt('select_account consent');

        // Load previously authorized token from a file, if it exists.
        // The file token.json stores the user's access and refresh tokens, and is
        // created automatically when the authorization flow completes for the first
        // time.
        $tokenPath = 'token.json';
        if (file_exists($tokenPath)) {
            $accessToken = json_decode(file_get_contents($tokenPath), true);
            $client->setAccessToken($accessToken);
        }

        // If there is no previous token or it's expired.
        if ($client->isAccessTokenExpired()) {
            // Refresh the token if possible, else fetch a new one.
            if ($client->getRefreshToken()) {
                $client->fetchAccessTokenWithRefreshToken($client->getRefreshToken());
            } else {
                // Request authorization from the user.
                $authUrl = $client->createAuthUrl();
                printf("Open the following link in your browser:\n%s\n", $authUrl);
                print 'Enter verification code: ';
                $authCode = trim(fgets(STDIN));

                // Exchange authorization code for an access token.
                $accessToken = $client->fetchAccessTokenWithAuthCode($authCode);
                $client->setAccessToken($accessToken);

                // Check to see if there was an error.
                if (array_key_exists('error', $accessToken)) {
                    throw new Exception(join(', ', $accessToken));
                }
            }
            // Save the token to a file.
            if (!file_exists(dirname($tokenPath))) {
                mkdir(dirname($tokenPath), 0700, true);
            }
            file_put_contents($tokenPath, json_encode($client->getAccessToken()));
        }
        return $client;
    }
}
