<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use App\Models\User;
use App\Models\Flower;
use App\Models\Customer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class TransactionsController extends Controller
{
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
       // Lakukan pengambilan nomor transaksi terbaru dari database
       // Misalnya, Anda bisa mengambil nomor transaksi terbaru dan menambahkannya dengan 1
       // Di sini saya akan menggunakan nomor transaksi acak untuk tujuan demonstrasi
       $latestTransactionNumber = mt_rand(100000, 999999); // Nomor transaksi acak
       return 'TRX' . str_pad($latestTransactionNumber, 6, '0', STR_PAD_LEFT); // Format nomor transaksi
   }

       public function store(Request $request)
       {
           try {
               // Validasi input
               $validatedData = $request->validate([
                   'date' => 'required|date',
                   'customer_id' => 'required|exists:customers,id',
                   'cash' => 'required|numeric|min:0',
                   'grand_total' => 'required|numeric|min:0',
                   'packaging' => 'nullable|string',
                   'cart_items' => 'required|array',
                   'cart_items.*.item_id' => 'required|exists:flowers,id',
                   'cart_items.*.flower_name' => 'required|string',
                   'cart_items.*.price' => 'required|numeric|min:0',
                   'cart_items.*.quantity' => 'required|integer|min:1',
                   'cart_items.*.subtotal' => 'required|numeric|min:0',
               ]);
   
               DB::beginTransaction();
               $userId = $request->session()->get('userId');
   
               // Buat transaksi baru
               $transaction = Transaction::create([
                   'no_transaction' => $this->generateTransactionNumber(),
                   'user_id' => $userId,
                   'customer_id' => $validatedData['customer_id'],
                   'date' => $validatedData['date'],
                   'grand_total' => $validatedData['grand_total'],
                   'packaging' => $validatedData['packaging'],
                   'cash' => $validatedData['cash'],
                   'change' => $validatedData['cash'] - $validatedData['grand_total'],
               ]);
   
               // Simpan item transaksi
               foreach ($validatedData['cart_items'] as $item) {
                   TransactionDetail::create([
                       'transaction_id' => $transaction->id,
                       'flower_id' => $item['item_id'],
                       'quantity' => $item['quantity'],
                       'price' => $item['price'],
                       'subtotal' => $item['subtotal'],
                   ]);
               }
   
               DB::commit();
   
               return response()->json(['message' => 'Transaction successful'], 200);
   
           } catch (ValidationException $e) {
               DB::rollBack();
               return response()->json(['errors' => $e->errors()], 422);
           } catch (\Exception $e) {
               DB::rollBack();
               Log::error('Transaction Error: ' . $e->getMessage());
               return response()->json(['message' => 'Internal Server Error'], 500);
           }
       }
}
