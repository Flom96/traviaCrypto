<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mquestion extends Model
{
    protected $fillable = [
        'match_id', 'que', 'option_1', 'option_2', 'option_3', 'option_4', 'answer',
    ];
}
