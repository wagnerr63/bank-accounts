<?php

use App\Entities\Type;
use App\Repositories\Accounts\MockAccountsRepository;
use App\Repositories\Events\MockEventsRepository;
use App\Usecases\RegisterEventUseCase;
use App\Usecases\RegisterEventUseCaseDTO;

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    $accountsRepository = MockAccountsRepository::getInstance();
    $eventsRepository = MockEventsRepository::getInstance();

    $registerEventUseCase = new RegisterEventUseCase();
    $data = new RegisterEventUseCaseDTO;

    $data->type = Type::DEPOSIT->toString();
    $data->destination = 7;
    $data->amount = 100;

    $registerEventUseCase->execute($data);

    echo "accounts ";
    var_export($accountsRepository->accounts);
    echo "<br>";
    var_export($eventsRepository->events);
    exit;

    return $router->app->version();
});

$router->get('/balance', 'GetBalanceByNumberController@handle');

$router->post('/event', 'RegisterEventController@handle');
