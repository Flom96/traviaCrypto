<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //

    public function Question() {
        return $this->hasMany('App\Question');
    }

    public function Match() {
        return $this->hasMany('App\Match');
    }
}
