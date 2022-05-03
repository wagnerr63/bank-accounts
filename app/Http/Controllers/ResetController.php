<?php

namespace App\Http\Controllers;

use App\Usecases\ResetRepositoryUseCase;
use Illuminate\Http\Request;

class ResetController extends Controller {
    public function __construct()
    {
        
    }

    public function handle(Request $request) {
        $resetRepositoryUseCase = new ResetRepositoryUseCase();
        try {
            $resetRepositoryUseCase->execute();
            return response(0, 200);
        } catch (\Exception $e) {
            return response(0, 400);
        }
    }
}