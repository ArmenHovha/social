<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Voted extends Model{
    protected $table = 'voted';
    protected $fillable = [ 'id_news','id_users', ];
}