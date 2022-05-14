<?php

namespace App\Repositories\Accounts;

use App\Repositories\Accounts\IAccountsRepository;
use Exception;

class MockAccountsRepository implements IAccountsRepository {
    private static $instance;
    public array $accounts;


    public function __construct()
    {
        $this->accounts = [];
    }

    static function getInstance(): self {
        if(self::$instance === null){
            self::$instance = new self;
        }
        return self::$instance;
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

    public function update(array $data): void {
        throw new Exception("not implemented");
    }

    public function reset(): void {
        $this->accounts = [];
    }
}
