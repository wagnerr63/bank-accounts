<?php

namespace App\Repositories\Accounts;

use App\Repositories\Accounts\IAccountsRepository;
use App\Models\Account;

class EloquentAccountsRepository implements IAccountsRepository {

    private Account $accountModel;

    public function __construct()
    {
        $this->accountModel = new Account;
    }

    public function findById(int|string $id): array
    {
        return $this->accountModel->where('id', $id)->get()->toArray();
    }

    public function findByNumber(int|string $number): array
    {   
        return $this->accountModel->where('number', $number)->get()->toArray();
    }

    public function create(array $data): void {
        $this->accountModel->create($data);
    }

    public function getBalanceByNumber(int|string $number): int
    {
        return $this->accountModel->where('number', $number)->get('balance')->toArray();
    }
}