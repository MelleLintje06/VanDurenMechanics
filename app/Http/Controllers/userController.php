<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\product;
use App\Models\category;
use App\Models\User;
use App\Models\contact;

class userController extends Controller
{
    // Toont alle gebruikers die toegang hebben tot de backend van de site
    public function users() {
        $users = User::all();
        return view('users/users', ['gebruikers'=> $users]);
    }
}
