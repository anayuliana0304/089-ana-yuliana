<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UsersController extends Controller
{

    public function index() {
         $users = User::all();
       
         return view('users.index',compact('users'));
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

        return redirect()->route('users.index');
    }

    public function update(string $id){
        $users = [
            [
                'id' => 1,
                'username' => 'admin',
                'name' => 'Ana Yuliana',
                'password' => '*********',
                'level' => 'admin'
            ],
            [
                'id' => 2,
                'username' => 'kasir1',
                'name' => 'Kaluna',
                'password' => '*********',
                'level' => 'kasir'
            ],
            [
                'id' => 3,
                'username' => 'kasir2',
                'name' => 'Karissa',
                'password' => '*********',
                'level' => 'kasir'
            ]
        ];

        $users = [];

        foreach ($users as $item) {
            if ($item["id"] == $id) {
                $users = $item;
            }
        }
        return view('users.update', [
            "users" => $users
        ]);
    }
}
