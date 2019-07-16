<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tran extends Model
{
    protected $fillable = [
        'user_id', 'type', 'amount', 'transaction_hash', 'fee', 'status', 'address'
    ];

    public function User() {
    	return $this->hasMany('App\User');
    }
}
