<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
class Message extends Model{
    protected $table = 'messages';
    protected $fillable = ['from_id', 'to_id', 'message','to_name','status' ];

    function user(){
        return $this->belongsTo(User::class);
    }
}