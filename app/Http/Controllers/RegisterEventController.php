<?php

namespace App\Http\Controllers;

use App\Usecases\RegisterEventUsecase;
use App\Usecases\RegisterEventUsecaseDTO;
use Illuminate\Http\Request;

class RegisterEventController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function handle(Request $request) {
        $registerEventUsecase = new RegisterEventUsecase();
        $data = new RegisterEventUsecaseDTO;
       
        $data->type = $request->json('type') ? $request->json('type') : "";
        $data->origin = $request->json('origin') ? $request->json('origin') : "";
        $data->destination = $request->json('destination') ? $request->json('destination') : "";
        $data->amount = $request->json('amount') ? $request->json('amount') : 0;

        try {

            $response = $registerEventUsecase->execute($data);
            return response($response, 201);

        } catch (\Exception $e) {
            return response($e->getMessage(), 400);
        }
    }
}
