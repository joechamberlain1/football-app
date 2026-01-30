<?php

require_once __DIR__ . '/vendor/autoload.php';

use Admin\FootballApp\FootballApp;
use Dotenv\Dotenv;
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

$footballApp = new FootballApp();

$allTeams = $footballApp->getAllTeams('PL'); 

$teamName = $argv[1] ?? "Newcastle United FC"; // Default to Newcastle United FC ID if no team inputted
echo "\nSearching for: '$teamName'\n";

if(isset($allTeams[$teamName])) {
    $teamID = $allTeams[$teamName];
} else {
    die("Team not found: $teamName\n");
}

$matches = $footballApp->getNextMatch('SCHEDULED', $teamID);

// Get the first match (next scheduled match)
$nextMatch = $matches['matches'][0];

// Display the opponent team information
echo "Next Match:\n";
echo "Date: " . $nextMatch['utcDate'] . "\n";
echo "Home Team: " . $nextMatch['homeTeam']['name'] . "\n";
echo "Away Team: " . $nextMatch['awayTeam']['name'] . "\n";
echo "Competition: " . $nextMatch['competition']['name'] . "\n";