<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Flower;

class FlowersController extends Controller
{
    public function index() {
        $flowers = Flower::all();
        
        return view('flowers.index', [
            'flowers' => $flowers
        ]);
    }

    public function create(){
        return view('flowers.create');
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
        ]);

        Flower::create($request->all());
        return redirect()->route('flowers.index')->with('success', 'Flower created successfully.');
    }

    public function edit($id){
        $flower = Flower::findOrFail($id);
        return view('flowers.edit',  ['flower' => $flower]);
    }

    public function update(Request $request, $id){
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
        ]);

       $flower = Flower::findOrFail($id);

       $flower->update($request->all());

       return redirect()->route('flowers.index')->with('success', 'Flower updated successfully.');
    }

    public function destroy($id){
        $flower = Flower::findOrFail($id);
        $flower->delete();

        return redirect()->route('flowers.index')->with('success', 'Flower deleted successfully.');
    }
}
