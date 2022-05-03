<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Account extends Model {
    protected $fillable = [
        'id', 'number', 'balance'
    ];

    public $incrementing = false;
}