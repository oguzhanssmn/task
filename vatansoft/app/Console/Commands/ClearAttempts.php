<?php

namespace App\Console\Commands;
use App\Http\Controllers\UserController;
use Illuminate\Console\Command;

class ClearAttempts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'clear_attempts';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
     * @return int
     */
    public function handle()
    {
        $clear = new UserController();
        $clear->restartCounter();
    }
}
