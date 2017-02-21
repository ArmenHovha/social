<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\User;
use App\Message;
use AuthenticatesUsers;

use Illuminate\Support\Facades\Auth;

class HappyBirthday extends Command


{


    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sms:birthday';

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
     * @return mixed
     */
    public function handle()
    {

        $users = User::get();

dd(User::Auth()->id);




        foreach ($users as $user) {
            $day = $user->birthday;
            $str = substr($day,5);
            dd(Auth::user()->id);
    if($str == date('m-d') ){
dd(Auth::user()->id);
        Message::create(
            [
                'from_id' => Auth::user()->id,
                'to_id'=> $user->id,
                'to_name' => $user->name,
                'message' => 'Dear'. $user->name . ', I wish you a happy birthday!',

            ]
        );

            }





        }
//        $this->info('The happy birthday messages were sent successfully!');

    }
}
