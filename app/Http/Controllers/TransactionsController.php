<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use App\Models\User;
use App\Models\Flower;
use App\Models\Customer;
use App\Models\Delivery;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class TransactionsController extends Controller
{
    public function index()
    {
        $transactions = Transaction::with('customer')
            ->orderByRaw("CASE WHEN status = 'process' THEN 0 ELSE 1 END") 
            ->orderBy('id', 'desc') 
            ->get();
        $customers = Customer::all();
        
        return view('transactions.index', compact('transactions', 'customers'));
    }
    
    public function show($id)
    {
        $transaction = Transaction::with(['customer', 'user', 'details.flower', 'delivery'])->findOrFail($id);
        return response()->json($transaction);
    }


    public function create() {
        $flowers = Flower::all();
        $customers = Customer::all();
  
        return view('transactions.sales', [
        'flowers' => $flowers,
        'customers' => $customers,
        ]);
   }

   private function generateTransactionNumber()
   {
       $latestTransactionNumber = mt_rand(100000, 999999); 
       return 'TRX' . str_pad($latestTransactionNumber, 6, '0', STR_PAD_LEFT);
   }

   public function store(Request $request) 
   {
        try {
            $validatedData = $request->validate([
                'date' => 'required|date',
                'customer_id' => 'required|exists:customers,id',
                'cash' => 'required|numeric|min:0',
                'grand_total' => 'required|numeric|min:0',
                'cart_items' => 'required|array',
                'cart_items.*.item_id' => 'required|exists:flowers,id',
                'cart_items.*.flower_name' => 'required|string',
                'cart_items.*.price' => 'required|numeric|min:0',
                'cart_items.*.quantity' => 'required|integer|min:1',
                'cart_items.*.subtotal' => 'required|numeric|min:0',
            ]);

            DB::beginTransaction();
            $userId = $request->session()->get('userId');

            $transaction = Transaction::create([
                'no_transaction' => $this->generateTransactionNumber(),
                'user_id' => $userId,
                'customer_id' => $validatedData['customer_id'],
                'date' => $validatedData['date'],
                'grand_total' => $validatedData['grand_total'],
                'cash' => $validatedData['cash'],
                'change' => $validatedData['cash'] - $validatedData['grand_total'],
                'total' => 'process',
            ]);

            foreach ($validatedData['cart_items'] as $item) {
                TransactionDetail::create([
                    'transaction_id' => $transaction->id,
                    'flower_id' => $item['item_id'],
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                    'subtotal' => $item['subtotal'],
                ]);

                $flower = Flower::find($item['item_id']);
                $flower->reduceStock($item['quantity']);
            }
            
            if ($request->delivery_method === 'delivery') {
                Delivery::create([
                    'transaction_id' => $transaction->id,
                    'method' => $request->delivery_method,
                    'date' => $request->delivery_date,
                    'time' => $request->delivery_time,
                    'address' => $request->delivery_address,
                ]);
            } elseif ($request->delivery_method === 'pickup') {
                Delivery::create([
                    'transaction_id' => $transaction->id,
                    'method' => $request->delivery_method,
                    'date' => $request->delivery_date,
                    'time' => $request->delivery_time,
                    'address' => null,
                ]);
            }
            

        DB::commit();

        session()->flash('success', 'Transaction successful');
        return response()->json(['redirect' => route('transactions.create')]);

        } catch (ValidationException $e) {
            DB::rollBack();
            Log::error('Validation error.', ['errors' => $e->errors()]);
            return response()->json(['errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Transaction Error: ' . $e->getMessage());
            return response()->json(['message' => 'Internal Server Error'], 500);
        }
    }

    public function changeStatus($id)
    {
        $transaction = Transaction::findOrFail($id);

        $transaction->status = 'finished';
        $transaction->save();

        return redirect()->route('transactions.index')->with('success', 'Transaction status has been updated successfully.');
    }
}
