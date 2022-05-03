<?php

namespace App\Usecases;

use App\Repositories\Accounts\EloquentAccountsRepository;
use App\Repositories\Accounts\IAccountsRepository;
use App\Repositories\Accounts\MockAccountsRepository;
use Exception;

class GetAccountByNumberUsecase {
    private IAccountsRepository $accountsRepository;

    public function __construct(IAccountsRepository $accountsRepository = null)
    {
        $this->accountsRepository = $accountsRepository ? $accountsRepository : new EloquentAccountsRepository;
    }

    public function execute(int|string $number): array {
        $accountByNumber = $this->accountsRepository->findByNumber($number);
        
        return isset($accountByNumber['number']) ? $accountByNumber : throw new Exception(0);
    }
}