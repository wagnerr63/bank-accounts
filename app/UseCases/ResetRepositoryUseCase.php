<?php

namespace App\Usecases;

use App\Repositories\Accounts\EloquentAccountsRepository;
use App\Repositories\Accounts\IAccountsRepository;
use App\Repositories\Events\EloquentEventsRepository;
use App\Repositories\Events\IEventsRepository;

class ResetRepositoryUseCase {
    private IAccountsRepository $accountsRepository;
    private IEventsRepository $eventsRepository;

    public function __construct(
        IAccountsRepository $accountsRepository = null,
        IEventsRepository $eventsRepository = null
    )
    {
        $this->accountsRepository = $accountsRepository ? $accountsRepository : new EloquentAccountsRepository();
        $this->eventsRepository = $eventsRepository ? $eventsRepository : new EloquentEventsRepository;

    }

    public function execute(): void {
        $this->eventsRepository->reset();
        $this->accountsRepository->reset();
    }
}