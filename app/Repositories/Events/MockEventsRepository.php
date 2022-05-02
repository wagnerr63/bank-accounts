<?php

namespace App\Repositories\Events;

class MockEventsRepository implements IEventsRepository {
    private array $events;

    public function __construct()
    {
        $this->events = [];
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

    
}