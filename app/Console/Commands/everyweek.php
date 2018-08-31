<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Console\Commands\TaskShedule;
use DB;
use Auth;
use App\Account;
use App\Periodic;
use App\Transaction;
class everyweek extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'every:week';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Periodic Transaction: weekly';

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
        $created_at = array();
        $user_id = array();
        $account = array();
        $amount = array();
        $i=0;
        $data = Periodic::where('duration',2)->get();
        foreach ($data as $da){
            $tags[$i] = $da->tags;
            $user_id[$i] = $da->user_id;
            $account[$i] = $da->account_name;
            $amount[$i] = $da->amount;
            $i++;
        }
        for($i=0;$i<count($data);$i++){
            $data_acc = Account::where('user_id',$user_id[$i])->where('name',$account[$i])->first();
            $cur_bal = $data_acc->current_balance;
            $prev_bal = $cur_bal;
            $cur_bal = $cur_bal - $amount[$i];
            $data_acc->current_balance = $cur_bal;
            $data_acc->save();
            $tran = new Transaction;
            $tran->account_id = $user_id[$i];
            $tran->description = "Periodic Transaction: Weekly";
            $tran->tags = $tags[$i];
            $tran->amount = $amount[$i];
            $tran->date = date("Y-m-d")." ".date("h:i:s");
            $tran->previous_balance = $prev_bal;
            $tran->current_balance = $cur_bal;
            $tran->account_name =$account[$i];
            $tran->type = 1;
            $tran->save();
        }
    }
}
