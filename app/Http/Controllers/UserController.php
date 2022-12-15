<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class UserController extends Controller
{
    public function index()
    {
        $followings = Auth::user()->followings;
        $users = User::all()->map(function ($user) use ($followings) {
            $user->following = $followings->contains($user->id);
            return $user;
        });

        return Inertia::render('UserList', [
            'users' => $users
        ]);
    }
}
