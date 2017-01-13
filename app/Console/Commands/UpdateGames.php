<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use GuzzleHttp\Client;

use App\Http\Controllers\BGGController;
use App\Boardgame;

class UpdateGames extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bgg:update {--all} {--hot}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update games from the BGG dataset';

    protected $lastBGGRequest = 0;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        if ($this->option('all')) {
            $this->handleFrom(1);
        } elseif ($this->option('hot')) {
            $this->handleHot();
        } else {
            $this->handleFromLast();
        }
    }

    protected function handleFrom($id)
    {
        $game = null;
        $id = 1;
        while ($game !== false) {
            $game = $this->handleOne($id);
            $id++;
        }
    }

    protected function handleHot()
    {
        $xml = $this->bggRequest('hot', ['query' => ['type' => 'boardgame']]);
        $this->info('Getting Hot List from BGG.');

        foreach ($xml->item as $item) {
            $this->handleOne((int)$item['id']);
        }
    }

    protected function handleFromLast()
    {
        $game = Boardgame::orderBy('updated_at')->take(1)->get();
        $this->handleFrom($game->id);
    }

    protected function handleOne($id)
    {
        $xml = $this->bggRequest('thing', [
            'query' => [
                'id' => $id,
                'stats' => 1
            ]
        ]);

        // This id has no bgg data
        $thing = $xml->item;
        if (!$thing) {
            return;
        }

        $game = BGGController::updateGame($thing);

        // We have reached the end of the list OR this is not the type we want
        // Either false or null
        if (!$game) {
            return $game;
        }

        BGGController::updateTags($thing, $game);
        BGGController::updatePlayerCounts($thing, $game);

        $this->info('Updated: '.$game->name);
    }

    protected function bggRequest($uri, $options)
    {
        $wait = 500000; // 0.5 seconds
        $waited = microtime() - $this->lastBGGRequest;
        if ($waited < $wait) {
            usleep($wait - $waited);
        }

        $client = new Client([
            'base_uri' => 'https://www.boardgamegeek.com/xmlapi2/'
        ]);
        $response = $client->get($uri, $options);

        $xml = new \SimpleXMLElement($response->getBody());

        $this->lastBGGRequest = microtime();

        return $xml;
    }
}
