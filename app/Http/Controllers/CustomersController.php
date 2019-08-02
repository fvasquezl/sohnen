<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;

class CustomersController extends Controller
{
    public function saveMemory(Request $request)
    {
        $request->validate([
            'CustomerName' => 'required',
            'PercentOfRetail' => 'required',
        ]);

        if (session()->has('CustomerName') && session()->has('CustomerName')) {
            //
        }else{
            session(['CustomerName' => $request->CustomerName]);
            session(['PercentOfRetail' => $request->PercentOfRetail]);
        }

        return response()->json([
            'success' => true,
            'CustomerName' => session('CustomerName'),
            'PercentOfRetail' => session('PercentOfRetail'),
            'message' => 'The Customer has been stored'
        ], 200);
    }

    public function removeMemory(Request $request)
    {
        if (session()->has('CustomerName') && session()->has('CustomerName')) {
            $request->session()->forget(['CustomerName', 'PercentOfRetail']);
        }

        return response()->json([
            'success' => true,
            'message' => 'The Customer has been deleted'
        ], 200);
    }

    public function store(Request $request)
    {

    }
}
