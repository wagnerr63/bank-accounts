<?php

namespace App\Repositories\Events;

class MockEventsRepository implements IEventsRepository {
    public array $events;
    private static $instance;
    

    public function __construct()
    {
        $this->events = [];
    }

    static function getInstance(): self {
        if(self::$instance === null){
            self::$instance = new self;
        }
        return self::$instance;
    }


    public function findById(int|string $id): array
    {
        $index = array_search($id, array_column($this->events, 'id'));
        if ($index===false) {
            return [];
        }
        return $this->events[$index];
    }

    public function create(array $data): void
    {
        array_push($this->events, $data);
    }

    public function reset(): void {
        $this->events = [];
    }

    
}