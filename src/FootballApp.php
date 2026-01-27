<?php

namespace Admin\FootballApp;

use GuzzleHttp\Client;

class FootballApp
{
    private const BASE_URL = 'https://api.football-data.org/v4/';
    private const TEAM_ID = 67; // Newcastle United FC ID
    private string $apiKey;

    private Client $client;

    public function __construct() {
        $this->apiKey = $_ENV['API_KEY'] ?? $_SERVER['API_KEY'] ?? '';
        $this->client = new Client();
    }

    public function getNextMatch(string $status = 'SCHEDULED', string $teamID = ''): array
    {
        $url = self::BASE_URL . 'teams/' . $teamID . '/matches';
        
        try {
            $response = $this->client->get($url, [
                'headers' => [
                    'X-Auth-Token' => $this->apiKey
                ],
                'query' => [
                    'status' => $status
                ]
            ]);
            
            return json_decode($response->getBody()->getContents(), true);
        } catch (\Exception $e) {
            throw new \Exception('Failed to fetch matches: ' . $e->getMessage());
        }
    }

}