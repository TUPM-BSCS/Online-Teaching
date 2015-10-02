<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Professor extends Model
{
    protected $table = 'professors';
    
     protected $fillable = [
         'firstname',
         'lastname',
         'about',
         'image',
         'inst_id',
         'user_id'
         ];
}
