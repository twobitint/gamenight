<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ImportCollection extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bgg:import {username}';

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
        //
    }
}
