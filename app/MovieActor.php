<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MovieActor extends Model
{
    //
    public $table = 'actor_movie';

    public $fillable = ['actor_id','movie_id'];
}
