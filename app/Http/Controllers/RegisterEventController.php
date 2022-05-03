<?php

namespace App\Http\Controllers;

use App\Usecases\RegisterEventUseCase;
use App\Usecases\RegisterEventUseCaseDTO;
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
        $registerEventUseCase = new RegisterEventUseCase();
        $data = new RegisterEventUseCaseDTO;
       
        $data->type = $request->json('type') ? $request->json('type') : "";
        $data->origin = $request->json('origin') ? $request->json('origin') : "";
        $data->destination = $request->json('destination') ? $request->json('destination') : "";
        $data->amount = $request->json('amount') ? $request->json('amount') : 0;

        try {

            $response = $registerEventUseCase->execute($data);
            return response($response, 201);

        } catch (\Exception $e) {
            return response($e->getMessage(), 400);
        }
    }
}
