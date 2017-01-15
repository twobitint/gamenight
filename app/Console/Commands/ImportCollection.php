<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Http\Controllers\BGGController;

use App\User;

class ImportCollection extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bgg:import {username} {--replace} {--localuser} {--force}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import a specific user collection from BGG into this database';

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
        $username = $this->argument('username');

        $xml = BGGController::bggRequest('collection', ['query' => [
            'username' => $username,
            'own' => 1
        ]]);
        $this->info('Getting Collection from BGG.');

        $game_ids = [];
        foreach ($xml->item as $item) {
            $id = (int)$item['objectid'];
            $game_ids[] = $id;
            $options = ['--id' => $id];
            if ($this->option('force')) {
                $options['--force'] = 'default';
            }
            $this->call('bgg:update', $options);
        }

        $user = User::where('username', $this->option('localuser') ? $this->option('localuser') : $username)->first();
        if ($user) {
            if ($this->option('replace')) {
                $user->games()->sync($game_ids);
                $this->info('Replaced BGG collection for '.$username);
            } else {
                $user->games()->syncWithoutDetaching($game_ids);
                $this->info('Synced BGG collection for '.$username);
            }
        } else {
            $this->info('No local user found for BGG user "'.$username.'". No sync.');
        }
    }
}
