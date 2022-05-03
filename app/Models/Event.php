<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model {
    protected $fillable = [
        'id', 'type', 'origin', 'destination', 'amount'
    ];

    public $incrementing = false;
}