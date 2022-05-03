<?php

namespace App\Http\Controllers;

use App\Usecases\GetAccountByNumberUsecase;
use Illuminate\Http\Request;

class GetBalanceByNumberController extends Controller
{
    public function handle(Request $request) {
        $number = $request->input('account_id');

        try {
            $getAccountByNumber = new GetAccountByNumberUsecase();
            $account = $getAccountByNumber->execute($number);

            return response($account['balance'], 200);
        } catch (\Exception $e) {
            return response($e->getMessage(), 404);
        }
    }
}
