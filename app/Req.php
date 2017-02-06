<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Req extends Model{
    protected $table = 'request';
    protected $fillable = ['in_id', 'to_id', 'status' ];


}