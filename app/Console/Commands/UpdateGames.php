<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use GuzzleHttp\Client;

use App\Boardgame;

class UpdateGames extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bgg:update {--all}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update games from the BGG dataset';

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
            $this->handleAll();
        } else {
            $this->handleFromLast();
        }
    }

    protected function handleAll()
    {
        $this->handleOne(1);
    }

    protected function handleFromLast()
    {
        $this->handleOne(1);
    }

    protected function handleOne($id)
    {
        $client = new Client([
            'base_uri' => 'https://www.boardgamegeek.com/xmlapi2/'
        ]);
        $response = $client->get('thing', [
            'query' => [
                'id' => $id,
                'stats' => 1
            ]
        ]);

        $xml = new \SimpleXMLElement($response->getBody());

        // This id has no bgg data
        $thing = $xml->item;
        if (!$thing) {
            return;
        }

        // We only want boardgames and expansions
        $type = $thing->attributes()->type;
        if ($type != 'boardgame' && $type != 'boardgameexpansion') {
            return;
        }

        $name = is_array($thing->name) ? $thing->name[0]->attributes()->value : $thing->name->attributes()->value;
        $rank = is_array($thing->statistics->ratings->ranks->rank) ?
            array_filter($thing->statistics->ratings->ranks->rank, function ($e) {
                return $e->attributes()->name == 'boardgame';
            })[0]->value :
            $thing->statistics->ratings->ranks->rank->attributes()->value;

        $game = Boardgame::updateOrCreate(
            ['id' => $id],
            [
                'name' => $name,
                'rank' => $rank,
                'type' => $type,
                'thumbnail' => $thing->thumbnail,
                'image' => $thing->image,
                'description' => $thing->description,
                'year' => $thing->yearpublished->attributes()->value,
                'min_players' => $thing->minplayers->attributes()->value,
                'max_players' => $thing->maxplayers->attributes()->value,
                'playtime' => $thing->playingtime->attributes()->value,
                'min_playtime' => $thing->minplaytime->attributes()->value,
                'max_playtime' => $thing->maxplaytime->attributes()->value,
                'users_rated' => $thing->statistics->ratings->usersrated->attributes()->value,
                'rating_average' => $thing->statistics->ratings->average->attributes()->value,
                'rating_bayes' => $thing->statistics->ratings->bayesaverage->attributes()->value,
                'stddev' => $thing->statistics->ratings->stddev->attributes()->value,
                'weight_count' => $thing->statistics->ratings->numweights->attributes()->value,
                'weight_average' => $thing->statistics->ratings->averageweight->attributes()->value
            ]
        );

        $this->info('Updated: '.$name);
    }
}
