<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
   protected $table ='productimage';

   protected $fillable =['product_id','link'];
}
