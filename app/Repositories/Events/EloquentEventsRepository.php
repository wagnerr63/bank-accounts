<?php

namespace App\Repositories\Events;

use App\Repositories\Events\IEventsRepository;
use App\Models\Event;

class EloquentEventsRepository implements IEventsRepository {

    private Event $eventModel;

    public function __construct()
    {
        $this->eventModel = new Event;
    }

    public function findById(int|string $id): array
    {
        return $this->eventModel->where('id', $id)->get()->first()->toArray();
    }

    public function create(array $data): void {
        $this->eventModel->create($data)->toArray();
    }

    public function reset(): void
    {
        $this->eventModel->where("id", "!=", "")->delete();
    }
}