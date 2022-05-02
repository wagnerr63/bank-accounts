<?php

namespace App\Entities;

use App\Entities\CoreEntity;

class Event extends CoreEntity {
    
    public string $type;
    public string|int $origin = "";
    public string|int $destination = "";
    public int $amount = 0;

    public function __construct()
    {
        parent::__construct();
    }
}


enum Type {
    case DEPOSIT;
    case WITHDRAW;
    case TRANSFER;

    public function toString(): string {
        return match($this) 
        {
            Type::DEPOSIT => 'deposit',   
            Type::WITHDRAW => 'withdraw',   
            Type::TRANSFER => 'transfer',   
        };
    }
}