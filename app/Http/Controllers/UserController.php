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

    public function addGeneratedExample()
    {
        $user = User::find(auth()->user()->id);
        $user->generated_examples += 1;
        $user->save();

        return redirect()->back();
    }

    public function addSolvedExample()
    {
        $user = User::find(auth()->user()->id);
        $user->solved_examples += 1;
        $user->save();

        return redirect()->back();
    }

    public function addPoints()
    {
        $user = User::find(auth()->user()->id);
        $user->points += 1;
        $user->save();

        return redirect()->back();
    }
}
