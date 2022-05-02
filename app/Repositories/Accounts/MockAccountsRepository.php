<?php

namespace App\Repositories\Accounts;

use App\Repositories\Accounts\IAccountsRepository;

class MockAccountsRepository implements IAccountsRepository {

    private array $accounts;

    public function __construct()
    {
        $this->accounts = [];
    }

    public function findById(int|string $id): array
    {
        $index = array_search($id, array_column($this->accounts, 'id'));
        if ($index===false) {
            return [];
        }
        return $this->accounts[$index];
    }

    public function create(array $data): void
    {
        array_push($this->accounts, $data);
    }

    public function findByNumber(int|string $number): array
    {
        $index = array_search($number, array_column($this->accounts, 'number'));
        if ($index===false) {
            return [];
        }
        return $this->accounts[$index];
    }

    public function getBalanceByNumber(int|string $number): int
    {
        $index = array_search($number, array_column($this->accounts, 'number'));
        if ($index===false) {
            return 0;
        }
        return $this->accounts[$index]['balance'];
    }

    public function reset(): void {
        $this->accounts = [];
    }
}