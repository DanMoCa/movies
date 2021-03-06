<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    //

    public $table = 'movie';

    public $timestamps = false;

    public function genre(){
      return $this->belongsTo('App\Genre');
    }

    public function actors(){
      return $this->belongsToMany('App\Actor');
    }
}
