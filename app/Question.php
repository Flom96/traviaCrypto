<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = [
        'category_id', 'que', 'option_1', 'option_2', 'option_3', 'option_4', 'answer',
    ];

    public function Category() {
    	return $this->belongsTo('App\Category');
    }
}
