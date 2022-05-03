<?php

namespace App\Http\Controllers;

use App\Usecases\GetAccountByNumberUseCase;
use Illuminate\Http\Request;

class GetBalanceByNumberController extends Controller
{
    public function handle(Request $request) {
        $number = $request->input('account_id');

        try {
            $getAccountByNumber = new GetAccountByNumberUseCase();
            $account = $getAccountByNumber->execute($number);

            return response($account['balance'], 200);
        } catch (\Exception $e) {
            return response($e->getMessage(), 404);
        }
    }
}
