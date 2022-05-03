<?php 

namespace App\Entities;

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