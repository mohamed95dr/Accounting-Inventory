<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function users()
    {
        $users = User::get();
        return view('users', ['users' => $users]);
    }
    public function userForm()
    {
    }
    public function store()
    {
    }
    public function delete($id)
    {
    }
    public function updateForm($id)
    {
    }
    public function saveUpdate($id)
    {
    }
}
