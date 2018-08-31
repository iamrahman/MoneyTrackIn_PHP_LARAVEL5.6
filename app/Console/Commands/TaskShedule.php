<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Console\Commands\TaskShedule;
use DB;
use Auth;
use App\Account;
use App\Periodic;
use App\Transaction;
class TaskShedule extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'task:shedule';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Periodic Transaction';

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

    }
}
