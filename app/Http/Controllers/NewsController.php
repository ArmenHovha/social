<?php

namespace App\Http\Controllers;
use \App\Users;
use \App\News;
use \App\Voted;
use \App\Lik;
use Illuminate\Http\Request;

use Illuminate\Foundation\Http\FormRequest;
use Validator;
use Auth;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{

    public function index()
    {

        $id = Auth::id();





        $param = News::select('news.*',
            'voted.id_news','voted.id_users')
            ->leftjoin('voted', function ($join) {
                $join->on('news.id', '=', 'voted.id_news')
                    ->where('voted.id_users', '=',Auth::id()  )
                  -> orOn('news.id', '=', 'voted.id_users')
                   ->where('voted.id_users', '=','news.id_user');
            })->get();


        return view('/news',compact('param','id'));
        //return view('/news', ['param' => $param, 'id' => $id,]);

    }


    public function addnews()
    {

        return view('/addnews');
    }

    public function postnews(Request $request)
    {
        $data = $request->all();
        $id = Auth::id();

        $validator = Validator::make($data, [
            'news_title' => 'required',
            'news_text' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->with(['error_danger' => trans('common.error_news')]);
        };
        $file = $request['image'];

        $destinationPath = public_path() . '/uploads/news';
        $filename = time() . '.' . $file->getClientOriginalExtension();


        News::insert(
            [
                'id_user' => $id,
                'news_title' => $request->news_title,
                'news_text' => $request->news_text,
                'news_image' => $filename,

            ]
        );

        $file->move($destinationPath, $filename);
        return redirect('/addnews');
    }

    public function edit(Request $request)
    {
        $news_title = $request->news_title;
        $news_text = $request->news_text;
        $id = $request->id;
        $data = $request->all();


        $validator = Validator::make($data, [
            'news_title' => 'max:20',
            'news_text' => 'max:250',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
        if ($validator->fails()) {
            echo 1;
            exit;
        };
        $file = $request['image'];

        $filename = time() . '.' . $file->getClientOriginalExtension();


        News::where('id', $id)
            ->update([
                'news_title' => $news_title,
                'news_text' => $news_text,
                'news_image' => $filename
            ]);
        Storage::disk('uploads')->put($filename, File::get($file));
        $edit = News::where('id', $id)->get();
        echo json_encode($edit);
        exit;


    }

    public function delete(Request $request)
    {
        $id = $request->id;
        $delete = News::where('id', $id)->delete();
        if ($delete) {
            echo 1;
        } else {
            echo 0;
        }
    }

    public function like(Request $request)
    {

        $key = $request->key;
        $id_news = $request->id_news;
        $id_users = Auth::Id();



            $check = Voted::where([
                'id_news' => $id_news,
                'id_users' => $id_users,
            ])->count();

            if($check == 0){
                 Voted::create([
                    'id_news' => $id_news,
                    'id_users' => $id_users,
                ]);
            }
           else{
                Voted::where([
                   'id_news' => $id_news,
                   'id_users' => $id_users,
               ])->delete();
           }

        $count_lik = Voted::where([
            'id_news' => $id_news
        ])->count();


        News::where([
            'id' => $id_news,


        ])->update([
            'lik' => $count_lik
        ]);

        echo $count_lik;
    }

}