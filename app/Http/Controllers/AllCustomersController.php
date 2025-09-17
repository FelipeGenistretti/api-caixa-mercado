<?php

namespace App\Http\Controllers;

use App\Factories\MakeAllCustomersService;
use InvalidArgumentException;

class AllCustomersController extends Controller
{
    public function index()
    {
        try {
            $allCustomersService = MakeAllCustomersService::make();
            $customers = $allCustomersService->execute();
            return response()->json(['customers'=>$customers]);
        } catch (InvalidArgumentException $e) {
            return response()->json(['error' => $e->getMessage()], 422);
        } catch (\Throwable $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
