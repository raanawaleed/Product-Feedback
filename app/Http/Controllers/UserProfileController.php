<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserProfileController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $feedbackItems = $user->feedbackItems; // Assuming you have defined the relationship in the User model
        
        return view('profile', compact('user', 'feedbackItems'));
    }
}
