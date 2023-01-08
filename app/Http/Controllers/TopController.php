<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TopController extends Controller
{
    public function top()
    {
        if(Auth::check()) {
            $user = Auth::user();
            $user_id = $user->id;
        } else {
            $user_id = null;
        }
        return view('top', compact('user_id'));
    }
}
