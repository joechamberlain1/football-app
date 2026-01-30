<?php

namespace Admin\FootballApp;

use GuzzleHttp\Client;

class FootballApp
{
    private string $apiEndpoint = 'https://api.football-data.org/v4/';
    private int $teamID;
    private string $apiKey;

    private Client $client;

    public function __construct() {
        $this->apiKey = $_ENV['API_KEY'] ?? $_SERVER['API_KEY'] ?? '';
        $this->client = new Client();
    }

    public function getNextMatch(string $status = 'SCHEDULED', int $teamID = 0, string $teamName = ""): array
    {
        $teamID = $teamID ?: $this->teamID;
        $url = $this->apiEndpoint . 'teams/' . $teamID . '/matches';

        $response = $this->client->get($url, [
            'headers' => [
                'X-Auth-Token' => $this->apiKey
            ],
            'query' => [
                'status' => $status
            ]
        ]);

        return json_decode($response->getBody()->getContents(), true);

    }

    public function getAllTeams($competitionCode = 'PL')
    {
        $url = $this->apiEndpoint . 'competitions/' . $competitionCode . '/teams';

        $response = $this->client->get($url, [
            'headers' => [
                'X-Auth-Token' => $this->apiKey
            ]
        ]);

        $data = json_decode($response->getBody()->getContents(), true);

        $teams = [];
            foreach($data["teams"] as $team){
                $teams[$team["name"]] = $team["id"];
            }
            return $teams;
    }

}