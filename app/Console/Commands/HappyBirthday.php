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

//        $users = User::get();

        $users = User::select('users.id', 'users.name', 'users.avatar',  'users.birthday','request.in_id', 'request.to_id', 'status')
            ->leftjoin('request', function ($join) {
                $join->on('users.id', '=', 'request.in_id')
                    ->where('request.status','=','2')
                    ->orOn('users.id', '=', 'request.to_id')
                    ->where('request.status','=','2');
            })->get();




        foreach ($users as $user) {




        Message::create(
            [
                'from_id' => $user->in_id,
                'to_id'=> $user->id,
                'to_name' => $user->name,
                'message' => 'Dear ' . $user->name . ', I wish you a happy birthday!',

            ]
        );







        }
//        $this->info('The happy birthday messages were sent successfully!');

    }
}
