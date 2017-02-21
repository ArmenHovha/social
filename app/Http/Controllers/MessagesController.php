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
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Contracts\Routing\ResponseFactory;
use PDF;
use Mail;
use App\Mail\KryptoniteFound;

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

        return response()->json($showmessage);
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

        $from_id = Auth::id();
        $to_id = $request->to_id;
        $message = $request->message;
        $to_name = $request->to_name;
        $file = $request->file;

        $data = $request->all();


        $validator = Validator::make($data, [

            'file' => 'mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        if(!empty($file)){
            $destinationPath = public_path('uploads/file');

            $filename = time().'.'.$file->getClientOriginalExtension();
            Message::insert([
                'from_id' => $from_id,
                'to_id' => $to_id,
                'message' => $message,
                'to_name' => $to_name,
                'file'=> $filename,

            ]);
            $file->move($destinationPath,$filename);
            return $filename;
        }
        else{
            Message::insert([
                'from_id' => $from_id,
                'to_id' => $to_id,
                'message' => $message,
                'to_name' => $to_name,

            ]);
        }





        $showmessage = Message::where([
            'from_id' => $from_id,
            'to_id' => $to_id,

        ])
            ->orwhere([
                'from_id' => $to_id,
                'to_id' => $from_id,

            ])->get();

        return response()->json($showmessage);
    }

    public  function downloadFile(Request $request){

        $filenam = $request->filename;
        $Path = public_path('uploads/file')."/".$filenam ;
        return response()->download($Path);


    }

    public function pdf(Request $request,$to_id,$to_name){
        $from_id = Auth::id();
        $user_name =  Auth::user()->name;

        $getmessage = Message::where([
            'from_id' => $from_id,
            'to_id' => $to_id,

        ])
            ->orwhere([
                'from_id' => $to_id,
                'to_id' => $from_id,

            ])->get();


        $pdf = PDF::loadView('pdf',['getmessage'=>$getmessage,'from_id'=>$from_id,'user_name'=>$user_name,'to_name'=>$to_name]);
        $data = $pdf->download('pdfview.pdf');


        $result =   Mail::send(['pdf'=>$data],['getmessage'=>$getmessage,'from_id'=>$from_id,'user_name'=>$user_name,'to_name'=>$to_name], function ($message) use ($data)
        {
            $message->attachData($data,'chat.pdf' );
            $message->from('armen89hovhannisyan@gmail.com', 'Armen');
            $message->to('armen.hovhannisyan89@mail.ru');
        });
        if(!$result){
            return redirect()->back()->with('status','Email is send');


        }
    }
}