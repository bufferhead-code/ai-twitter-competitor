<?php

namespace App\Http\Controllers;
use App\Models\Tweet;
use Illuminate\Http\Request;

class TweetController extends Controller
{
    public function store(Request $request)
    {
        $tweet = Tweet::create([
            'status' => $request->input('status'),
            'user_id' => auth()->user()->id,
        ]);

        return redirect('/dashboard')->with('success', 'Post sent!');
    }
}
