<?php

namespace Tests;

use App\Entities\Account;
use App\Usecases\GetAccountByNumberUsecase;
use App\Repositories\Accounts\MockAccountsRepository;
use Exception;

class GetAccountByNumberUsecaseTest  extends TestCase {

    public function testGetANonExistingAccount(): void {
        $accountsRepository = new MockAccountsRepository;
        $getAccountByNumberUseCase = new GetAccountByNumberUsecase($accountsRepository);

        $this->expectException(Exception::class);
        $this->expectExceptionMessage(0);
        $getAccountByNumberUseCase->execute(1234);
    }

    public function testGetAnExistingAccount(): void {
        $accountsRepository = new MockAccountsRepository;
        $getAccountByNumberUseCase = new GetAccountByNumberUsecase($accountsRepository);

        $account = new Account();
        $account->number = "100";

        $accountsRepository->create((array) $account);

        $accountByNumber = $getAccountByNumberUseCase->execute("100");

        $this->assertSame((array) $account, $accountByNumber, "Should be able to get an existing account by number");
    }
}
