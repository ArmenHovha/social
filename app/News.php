<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class News extends Model{
    protected $table = 'news';
    protected $fillable = ['id_user', 'news_title', 'news_text', 'news_image','lik' ];

    function user(){
        return $this->belongsTo(User::class);
    }
}