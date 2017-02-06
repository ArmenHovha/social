<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model{
    protected $table = 'products';
     protected $fillable = ['arm_product_name', 'eng_product_name', 'price', 'quantity','arm_Product_Info',
         '	eng_Product_Info',
         ];
}
