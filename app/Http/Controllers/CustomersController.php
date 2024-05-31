<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;

class CustomersController extends Controller
{
    public function index() {
        $customers = Customer::all();
        
        return view('customers.index', [
            'customers' => $customers
        ]);
    }

    public function create(){
        return view('customers.create');
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required',
            'gender' => 'required',
        ]);

        Customer::create($request->all());
        return redirect()->route('customers.index')->with('success', 'Customer created successfully');
    }

    public function edit($id){
        $customer = Customer::all()->find($id);

        return view('customers.edit', [
            'customer' => $customer,
        ]);
    }

    public function update(Request $request, $id){
        $request->validate([
            'name' => 'required',
            'gender' => 'required',
        ]);

       $customer = Customer::findOrFail($id);

       $customer->update($request->all());

       return redirect()->route('customers.index')->with('success', 'Customer updated successfully.');
    }

    public function destroy($id)
    {
        \Log::info('Destroy method called for customer ID: ' . $id);
        $customer = Customer::findOrFail($id);
        $customer->delete();

        return redirect()->route('customers.index')->with('success', 'Customer deleted successfully.');
    }

}
