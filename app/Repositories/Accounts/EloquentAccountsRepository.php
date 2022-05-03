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
        $account = $this->accountModel->where('id', $id)->get()->first();
        return $account ? $account->toArray() : [];
    }

    public function findByNumber(int|string $number): array
    {      
        $account = $this->accountModel->where('number', $number)->get()->first();
        return $account ? $account->toArray() : [];
    }

    public function create(array $data): void {
        $this->accountModel->create($data);
    }

    public function getBalanceByNumber(int|string $number): int
    {   
        $balance = $this->accountModel->where('number', $number)->get('balance')->first();
        return $balance ? $balance->toArray() : 0;
    }

    public function update(array $data): void
    {   
        $this->accountModel->where(['id' => $data['id']])->update($data);
    }

    public function reset(): void
    {
        $this->accountModel->where("id", "!=", "")->delete();
    }
}