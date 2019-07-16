<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Match extends Model
{
    protected $fillable = [
        'category_id', 'user1_id', 'user2_id'
    ];

    public function Category() {
    	return $this->belongsTo('App\Category');
    }

    public function User() {
    	return $this->hasMany('App\User');
    }
}
