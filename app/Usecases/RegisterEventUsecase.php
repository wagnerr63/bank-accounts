<?php

namespace App\Usecases;

use App\Entities\Account;
use App\Entities\Event;
use App\Entities\Type;
use App\Repositories\Accounts\EloquentAccountsRepository;
use App\Repositories\Accounts\IAccountsRepository;
use App\Repositories\Accounts\MockAccountsRepository;
use App\Repositories\Events\EloquentEventsRepository;
use App\Repositories\Events\IEventsRepository;
use Exception;

class RegisterEventUsecaseDTO {
    public string $type = "";
    public string $destination = "";
    public string $origin = "";
    public int $amount = 0;
}


class RegisterEventUsecase {
    private IEventsRepository $eventsRepository;
    private IAccountsRepository $accountsRepository;

    public function __construct(
        IEventsRepository $eventsRepository = null,
        IAccountsRepository $accountsRepository = null
    )
    {
        $this->eventsRepository = $eventsRepository ? $eventsRepository : new EloquentEventsRepository;
        $this->accountsRepository = $accountsRepository ? $accountsRepository : new EloquentAccountsRepository;
    }

    public function execute(RegisterEventUsecaseDTO $data): array {
        switch ($data->type) {
            case Type::DEPOSIT->toString():

                if($data->amount <= 0) {
                    throw new Exception("cannot deposit an amount less than zero");
                }

                if ($data->destination == "") {
                    throw new Exception("invalid account id");
                }

                $accountByNumber = $this->accountsRepository->findByNumber($data->destination);
                if (!isset($accountByNumber['id'])) {
                    $account = new Account();
                    $account->number = $data->destination;
                    $account->balance = $data->amount>= 0  ? $data->amount : 0;

                    $this->accountsRepository->create((array) $account);
                    
                    
                    $event = new Event();
                    $event->type = $data->type;
                    $event->destination = $data->destination;
                    $event->amount = $data->amount;

                    $this->eventsRepository->create((array) $event);

                    return ['destination' => [
                        'id' => $data->destination,
                        'balance' => $account->balance
                        ]
                    ];
                } else {
                    $event = new Event();
                    $event->type = $data->type;
                    $event->destination = $data->destination;
                    $event->amount = $data->amount;

                    $this->eventsRepository->create((array) $event);

                    $newBalance = (int) $accountByNumber['balance'] + $data->amount;
                    $this->accountsRepository->update(['id' => $accountByNumber['id'], 'balance' => $newBalance]);

                    return ['destination' => [
                        'id' => $data->destination,
                        'balance' => $newBalance
                        ]
                    ];
                    
                }
            break;

            case Type::WITHDRAW->toString():
                $accountByNumber = $this->accountsRepository->findByNumber($data->origin);
                
                if (!isset($accountByNumber['id'])) {
                    throw new Exception(0);
                }

                $event = new Event();
                $event->amount = $data->amount;
                $event->origin = $data->origin;
                $event->type = $data->type;

                $this->eventsRepository->create((array) $event);
                
                $newBalance = (int) $accountByNumber['balance'] - $data->amount;
                $this->accountsRepository->update(['id' => $accountByNumber['id'], 'balance' => $newBalance]);

                return [
                    "origin" => [
                        "id" => $accountByNumber['number'],
                        "balance" => $newBalance,
                    ]
                ];
            break;

            case Type::TRANSFER->toString():
                # code...
            break;
            
            default:
                throw new Exception("invalid event type");
            break;
        }
    }
}