<?php

namespace App\Entities;

use DateTime;
use Ramsey\Uuid\Uuid;

class CoreEntity {
    public int|string $id = "";
    public string $created_at;
    public string $updated_at;

    public function __construct()
    {
        if (!$this->id) {
            $this->id = (string) Uuid::uuid4();
            
            $dateTime = new DateTime();

            $this->created_at = $dateTime->format('Y-m-d H:i:s');
            $this->updated_at = $dateTime->format('Y-m-d H:i:s');
        }
    }
}