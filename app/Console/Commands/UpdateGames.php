<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use Carbon\Carbon;

use App\Http\Controllers\BGGController;
use App\Boardgame;

class UpdateGames extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bgg:update {--all} {--hot} {--id=} {--collection=} {--force}';

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
            $this->handleFrom(1);
        } elseif ($this->option('hot')) {
            $this->handleHot();
        } elseif ($this->option('id')) {
            $this->handleOne($this->option('id'));
        } elseif ($this->option('collection')) {
            $this->handleCollection($this->option('collection'));
        } else {
            $this->handleFromLast();
        }
    }

    protected function handleCollection($username)
    {

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
        $xml = BGGController::bggRequest('hot', ['query' => ['type' => 'boardgame']]);
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
        // Don't query for a thing if it's less than a day old
        if (!$this->option('force')) {
            $game = Boardgame::find($id);
            if ($game && $game->updated_at->gt(Carbon::yesterday())) {
                $this->info('Skipping '.$game->name.'. Too recent.');
                return null;
            }
        }

        $xml = BGGController::bggRequest('thing', [
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
        BGGController::updateRanks($thing, $game);

        $this->info('Updated: '.$game->name);
    }
}
