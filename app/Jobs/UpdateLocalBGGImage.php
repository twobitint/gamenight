<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Log;

use Image;
use Storage;
use Carbon\Carbon;

use App\Boardgame;

class UpdateLocalBGGImage implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $boardgame;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Boardgame $game)
    {
        $this->boardgame = $game;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $filename = 'bgg/game-images/' . $this->boardgame->id . '.jpg';

        // Don't run the job if it's already been run before
        if (!Storage::disk('public')->exists($filename)) {
            $img = Image::make($this->boardgame->image)
                ->fit(720, 200)
                ->encode('jpg', 75);
            Storage::disk('public')
                ->put($filename, $img);

            // Ensure expensive image resources are freed after manipulation
            $img->destroy();

            $this->boardgame->image_cached_at = Carbon::now();
            $this->boardgame->save();
        }
    }

    /**
     * The job failed to process.
     *
     * @param  Exception  $exception
     * @return void
     */
    public function failed(\Exception $exception)
    {
        Log::debug($exception);
        // $this->error('Failed saving image from: ' . $this->boardgame->name);
        // $this->error($exception);
    }
}
