<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TransactionDetailController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'transaction_id' => 'required|exists:transactions,id',
            'flower_id' => 'required|exists:flowers,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $flowerPrice = Flower::find($request->flower_id)->price;
        $total = $flowerPrice * $request->quantity;

        $detail = TransactionDetail::create([
            'transaction_id' => $request->transaction_id,
            'flower_id' => $request->flower_id,
            'quantity' => $request->quantity,
            'price' => $flowerPrice,
            'total' => $total,
        ]);

        return response()->json(['success' => true, 'message' => 'Transaction detail created successfully', 'detail' => $detail]);
    }
}
