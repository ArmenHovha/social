<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Cache;
use App\Message;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','avatar'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
     function social(){
        return $this->hasMany(Social::class);
    }
    public function isOnline()
    {
        return Cache::has('user-is-online-' . $this->id);
    }

    function messages(){
        return $this->hasMany('App\Message','from_id');
    }

    public function messagesCount()
    {
        $count = $this->messages()
        ->selectRaw('to_id, count(*) as countmessage')->where('status',0)
        // ->selectRaw('from_id, count(*) as countmessage')->where('status',1)
        ->groupBy('to_id');
        return $count;
    }
    function news(){
        return $this->hasMany(News::class);
    }

}
