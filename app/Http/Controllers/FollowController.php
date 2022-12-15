<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FollowController extends Controller
{
    public function follow(Request $request)
    {
        $user = Auth::user();

        if ($user->followings->contains($request->id)) {
            $user->followings()->detach($request->id);
        } else {
            $user->followings()->attach($request->id);
        }
    }
}
