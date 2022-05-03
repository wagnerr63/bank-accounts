<?php 

namespace App\Repositories;

interface IBaseRepository {
    public function findById(int|string $id): array;
    public function create(array $data): void;
    public function reset(): void;
}