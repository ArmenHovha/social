<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lik extends Model{
    protected $table = 'lik';
    protected $fillable = ['lik', 'unlik', 'id_news', ];
}