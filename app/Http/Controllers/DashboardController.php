<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Customer;
use App\Models\Flower;
use App\Models\User;
use App\Models\Transaction;

class DashboardController extends Controller
{
    public function index() {

        $customerCount = Customer::count();
        $flowerCount = Flower::count();
        $userCount = User::count();
        $transactionCount = Transaction::count();

        return view('dashboard', compact('customerCount', 'flowerCount', 'userCount', 'transactionCount'));
    }
}
