<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::where('is_teacher', 0)->get();

        return view('students', compact('users'));
    }
}
