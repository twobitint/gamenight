<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Boardgame;
use App\Jobs\UpdateLocalBGGImage;

use DB;

class UpdateImages extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bgg:images {--limit=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Download and resize BGG images for performance';

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
        $limit = $this->option('limit', 100);
        $games = Boardgame::whereNull('image_cached_at')
            ->orderByRaw('ISNULL(rank)')
            ->orderBy('rank')
            ->orderBy('rating_average', 'desc')
            ->limit($limit)
            ->get();
        foreach ($games as $game) {
            $job = (new UpdateLocalBGGImage($game))->onQueue('images');
            dispatch($job);
        }
        // This doesn't work
        //$this->info('Queued image jobs successfully.');
    }
}
