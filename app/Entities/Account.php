<?php

namespace App\Entities;

use App\Entities\CoreEntity;


class Account extends CoreEntity {
    public string $number;
    public int $balance = 0;

    public function __construct()
    {   
        if (!$this->id) {
            $this->balance = 0;
        }

        parent::__construct();
    }
}