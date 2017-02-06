<?php

namespace App\Http\Controllers;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;
use Validator;
use App\User;
use App\Req;
use App\Message;


class MessagesController extends Controller
{


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()

    {
        $users = User::get();

        $id = Auth::id();

        return view('/messages', compact('users', 'id'));

    }

    public function countOneMessage()

    {
//        $users =  User::get();
//        $messageCount = 0;
//        if(!empty($users)){
//            foreach ($users as $value){
//
//                foreach ($value->messagesCount as $count){
//
//                    if($count){
//                        $messageCount[$value->id]= $count['countmessage'];
//
//                    }
//                   else{
//                       $messageCount = 0;
//                   }
//
//                }
//
//
//            }
//
//        }
        $currentuser_id = Auth::user()->id;
        $getmessages = Message::select('from_id')
                                ->where('to_id',$currentuser_id)
                                ->where('status',0)
                                ->get();
        $messageCount = array();
        if (!empty($getmessages)){
            foreach ($getmessages as $value){
                $messageCount[$value->from_id]= 0;
            }
            foreach ($getmessages as $value){
                $messageCount[$value->from_id] = $messageCount[$value->from_id] +1;
            }

        }

        return response($messageCount);

    }

    public function showOneMessage(Request $request){
        $from_id = Auth::id();
        $to_id = $request->to_id;

        $showmessage = Message::where([
            'from_id' => $from_id,
            'to_id' => $to_id,

        ])
            ->orwhere([
                'from_id' => $to_id,
                'to_id' => $from_id,

            ])->get();
        Message::where([
            'from_id' => $to_id,
            'to_id' => $from_id,
        ])->update([
            'status' => 1,
        ]);

        return response($showmessage);
    }

    public function countmessage(Request $request){
        $from_id = Auth::id();
        $count = Message::where([
            'to_id' => $from_id,
            'status' => 0,
        ])->count();
        return $count;
    }


    public function showintervalOneMessage(Request $request)
    {
        $from_id = Auth::id();
        $to_id = $request->to_id;


        $showmessage = Message::where([
            'to_id' => $from_id,
            'status' => 0,
        ])->get();

        Message::where([
            'to_id' => $from_id,
            'status' => 0,
        ])->update([
            'status' => 1,
        ]);

        return response($showmessage);

    }
    public function postChatMessage(Request $request)
    {
        dd($request->all());
        $from_id = Auth::id();
        $to_id = $request->to_id;
        $message = $request->message;
        $to_name = $request->to_name;
        Message::insert([
            'from_id' => $from_id,
            'to_id' => $to_id,
            'message' => $message,
            'to_name' => $to_name,
        ]);

        $showmessage = Message::where([
            'from_id' => $from_id,
            'to_id' => $to_id,

        ])
            ->orwhere([
                'from_id' => $to_id,
                'to_id' => $from_id,

            ])->get();

        return response($showmessage);
    }
}
