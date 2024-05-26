<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DeliveryController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'transaction_id' => 'required|exists:transactions,id',
            'method' => 'required|in:pickup,delivery',
            'date' => 'required_if:method,delivery|date',
            'time' => 'required_if:method,delivery|date_format:H:i',
            'address' => 'required_if:method,delivery',
        ]);

        $delivery = Delivery::create($request->all());

        return response()->json($delivery, 201);
    }

}
