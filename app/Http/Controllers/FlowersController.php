<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Flower;
use App\Models\Category;

class FlowersController extends Controller
{
    public function index() {
        $flowers = Flower::with('category')->get();
        $categories = Category::all();
        
        return view('flowers.index', [
            'flowers' => $flowers,
            'categories' => $categories,
        ]);
    }

    public function create(){
        $categories = Category::all();
        return view('flowers.create', [
            'categories' => $categories
        ]);
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required|unique:flowers',
            'price' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
            'stock' => 'required|integer',
        ]);

        Flower::create($request->all());
        return redirect()->route('flowers.index')->with('success', 'Flower created successfully.');
    }

    public function edit($id){
        $flower = Flower::findOrFail($id);
        $categories = Category::all();
        return view('flowers.edit',  [
            'flower' => $flower,
            'categories' => $categories
        ]);
    }

    public function update(Request $request, $id){
        $request->validate([
            'name' => 'required|unique:flowers,name,'.$id,
            'price' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
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

    public function categoriesIndex() {
        $categories = Category::all();
        return view('flowers.categories.index', ['categories' => $categories]);
    }

    public function categoriesCreate() {
        return view('flowers.categories.create');
    }

    public function categoriesStore(Request $request) {
        $request->validate([
            'name' => 'required|unique:categories'
        ]);

        Category::create($request->all());
        return redirect()->route('flowers.categories.index')->with('success', 'Category created successfully.');
    }

    public function categoriesEdit($id) {
        $category = Category::findOrFail($id);
        return view('flowers.categories.edit', ['category' => $category]);
    }

    public function categoriesUpdate(Request $request, $id) {
        $request->validate([
            'name' => 'required|unique:categories,name,'.$id
        ]);

        $category = Category::findOrFail($id);
        $category->update($request->all());

        return redirect()->route('flowers.categories.index')->with('success', 'Category updated successfully.');
    }

    public function categoriesDestroy($id) {
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect()->route('flowers.categories.index')->with('success', 'Category deleted successfully.');
    }
}
