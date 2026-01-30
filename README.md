# Football App

A PHP command-line application to fetch and display next scheduled football matches for teams using the football-data.org API.

## Features

- Look up teams by name
- Get the next scheduled match for any team
- Display match details including date, teams, and competition
- Supports Premier League and other major competitions

## Requirements

- PHP 8.0 or higher
- Composer
- football-data.org API key (free tier available)

## Installation

1. Clone the repository:
```bash
git clone <repository-url>
cd football-app
```

2. Install dependencies:
```bash
composer install
```

3. Create a `.env` file in the root directory:
```bash
touch .env
```

4. Add your API key to the `.env` file:
```
API_KEY=your_api_key_here
```

Get your free API key from [football-data.org](https://www.football-data.org/client/register)

## Usage

### Basic Usage

Run the script with a team name:
```bash
php football.php "Team Name"
```

### Examples

```bash
# Get Newcastle United FC's next match
php football.php "Newcastle United FC"

# Get Arsenal's next match
php football.php "Arsenal FC"

# Get Manchester United's next match
php football.php "Manchester United FC"
```

**Note:** Team names must match exactly as they appear in the API. Use quotes for multi-word team names.

### Default Team

If no team name is provided, the app defaults to "Newcastle United FC":
```bash
php football.php
```

## Competition Codes

The app currently searches teams in the Premier League (PL). To use different competitions, modify the competition code in `football.php`:

```php
$allTeams = $footballApp->getAllTeams('PL'); // Change 'PL' to another code
```

### Available Competition Codes:
- `PL` - Premier League (England)
- `PD` - La Liga (Spain)
- `BL1` - Bundesliga (Germany)
- `SA` - Serie A (Italy)
- `FL1` - Ligue 1 (France)
- `CL` - UEFA Champions League

## Output

The application displays:
- Match date and time (UTC)
- Home team name
- Away team name
- Competition name

Example output:
```
Searching for: 'Arsenal FC'
Next Match:
Date: 2026-02-01T15:00:00Z
Home Team: Arsenal FC
Away Team: Chelsea FC
Competition: Premier League
```

## API Limitations

The free tier of football-data.org API has limitations:
- Limited to specific competitions
- Some teams may not be accessible
- Rate limits apply (10 requests per minute)

If you receive a `403 Forbidden` error, the team or competition may not be included in your API tier.

## Troubleshooting

### "Team not found" error
- Ensure the team name matches exactly (case-sensitive)
- Verify the team is in the selected competition
- Check that the team is available in your API tier

### "403 Forbidden" error
- The team/competition is not available in your API tier
- Try a team from a major league (Premier League, La Liga, etc.)

### "Undefined array key" errors
- The team may not have any scheduled matches
- The API response structure may have changed

## License

MIT License

## Author

joechamberlain1
