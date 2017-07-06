<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{

     protected $table = 'followers';

     protected $guarded = ['created_at', 'updated_at'];

}
