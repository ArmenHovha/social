<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;
use Validator;
use App\User;
use App\Req;
use App\Message;

//use Carbon\Carbon;
//use Cache;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)

    {


        $id = Auth::id();
        $user_name =Auth::user()->name;
        $param = Auth::user();



        $users = User::select('users.id', 'users.name', 'users.avatar', 'request.in_id', 'request.to_id', 'status')
            ->leftjoin('request', function ($join) {
                $join->on('users.id', '=', 'request.in_id')
                    ->where('request.to_id', '=', Auth::id())
                    ->orOn('users.id', '=', 'request.to_id')
                    ->where('request.in_id', '=', Auth::id());
            })->WHERE('users.id', '!=', Auth::id())->paginate(2);

        if ($request->ajax()) {
        return view('home')->with(['users' => $users,
            'id' => $id,'user_name' => $user_name,'param' => $param])->render();

    }

        return view('/home', compact('param', 'users', 'id', 'user_name'));

    }

    public function upload(Request $request)
    {

        $id = auth::id();
        $file = $request['image'];
        $destinationPath = public_path() . '/uploads';
        $filename = time() . '.' . $file->getClientOriginalExtension();

        User::where('id', $id)
            ->update(
                [
                    'avatar' => $filename,
                ]
            );
        $file->move($destinationPath, $filename);
        return redirect('/home');
    }

    public function addfriends(Request $request)
    {
        $key = $request->key;

        $to_id = $request->to_id;
        $in_id = auth::id();
        if ($key == 'add') {
            $req = Req::insert([
                'in_id' => $in_id,
                'to_id' => $to_id,
                'status' => 1,
            ]);
            if ($req) {
                echo 1;
            } else {
                echo 0;
            }
            exit;
        } else if ($key == 'yes') {
            $req = Req::where([
                'in_id' => $to_id,
                'to_id' => $in_id,
            ])
                ->update([
                    'status' => 2,
                ]);
            if ($req) {
                echo 2;
            } else {
                echo 0;
            }
            exit;
        } else if ($key == 'no') {
            $req = Req::where([
                'in_id' => $to_id,
                'to_id' => $in_id,
            ])
                ->orwhere([
                    'in_id' => $in_id,
                    'to_id' => $to_id,
                ])
                ->delete();
            if ($req) {
                echo 3;
            } else {
                echo 0;
            }
            exit;
        }

    }

    public function showmessage(Request $request)
    {
        // $from_id = $request->from_id;
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
        return response($showmessage);

    }


    public function postmessage(Request $request)
    {
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

//    public function showintervalmessage(Request $request)
//    {
//        $from_id = Auth::id();
//        $to_id = $request->to_id;
//
//
//        $showmessage = Message::where([
//            'to_id' => $from_id,
//            'status' => 0,
//        ])->get();
//
//
////        Message::where([
////            'to_id' => $from_id,
////            'status' => 0,
////        ])->update([
////            'status' => 1,
////        ]);
//
//        echo json_encode($showmessage);
//        exit;
//    }

public function ajaxUser(Request $request,$page){


    $id = Auth::id();
    $user_name =Auth::user()->name;
    $param = Auth::user();



    $users = User::select('users.id', 'users.name', 'users.avatar', 'request.in_id', 'request.to_id', 'status')
        ->leftjoin('request', function ($join) {
            $join->on('users.id', '=', 'request.in_id')
                ->where('request.to_id', '=', Auth::id())
                ->orOn('users.id', '=', 'request.to_id')
                ->where('request.in_id', '=', Auth::id());
        })->paginate(2);



    return view('home')->with(['users' => $users,
        'id' => $id,'user_name' => $user_name,'param' => $param])->render();

         }

         public function calendar(){

             $id = Auth::id();
             $user_name =Auth::user()->name;
             $param = Auth::user();



             $users = User::select('users.id', 'users.name', 'users.avatar','users.birthday', 'request.in_id', 'request.to_id', 'status')
                 ->leftjoin('request', function ($join) {
                     $join->on('users.id', '=', 'request.in_id')
                         ->where(['request.to_id'=> Auth::id(),
                             'request.status'=> '2'
                         ])

                         ->orOn('users.id', '=', 'request.to_id')
                         ->where(['request.in_id'=> Auth::id(),
                             'request.status'=> '2'
                         ])

                     ;
                 })->get();
                return response()->json($users);
         }

}
