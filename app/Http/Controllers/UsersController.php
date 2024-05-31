<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UsersController extends Controller
{

    public function index() {
         $users = User::all();
       
         return view('users.index',[
            'users' => $users,
         ]);
    }

    public function create(){
        return view('users.create');
    }

    public function store(Request $request){
        $request->validate([
            'username' => 'required|unique:users',
            'name' => 'required',
            'password' => 'required',
            'level' => 'required'
        ]);

        User::create([
            'username' => $request->username,
            'name' => $request->name,
            'password' => bcrypt($request->password),
            'level' => $request->level,
        ]);

        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }

    public function edit($id){
        $user = User::all()->find($id);

        return view('users.edit', [
            'user' => $user,
        ]);
    }

    public function update(Request $request, $id){
        $request->validate([
            'username' => 'required|unique:users,username,'.$id,
            'name' => 'required',
            'password' => 'sometimes|nullable',
            'level' => 'required'
        ]);

       $user = User::findOrFail($id);

       $user->username = $request->username;
       $user->name = $request->name;
       if($request->password){
            $user->password = bcrypt($request->password);
       }
       $user->level = $request->level;

       $user->save();

       return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }

    public function destroy($id){
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }
}
