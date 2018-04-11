<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Actor extends Model
{
    //
    public $table = 'actors';

    public function movies(){
      return $this->belongsToMany('App\Movie');
    }
}
