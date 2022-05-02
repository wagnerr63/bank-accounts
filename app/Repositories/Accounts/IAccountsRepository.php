<?php

namespace App\Repositories\Accounts;

use App\Repositories\IBaseRepository;

interface IAccountsRepository extends IBaseRepository {
    public function getBalanceByNumber(int|string $number): int;
}