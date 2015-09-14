<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Institution extends Model
{
    protected $table = 'institutions';
        
     protected $fillable = [
         'name',
         'description',
         'contactno',
         'logo'
         ];
     
}
