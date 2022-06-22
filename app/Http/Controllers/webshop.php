<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use App\Models\product;
use App\Models\category;
use App\Models\User;
use App\Models\contact;

class webshop extends Controller
{
    public function index () {
        $products = product::whereNotNull('productSalesprice')->get();
        $categories = category::all();
        return view('home', ['products'=> $products], ['categories'=> $categories]);
    }

    public function store(Request $request) {
        $catslug = $request->input('cat', '');
        $products = product::all();
        $categories = category::all();
        return view('products/webshop', ['products'=> $products], ['categories'=> $categories]);
    }

    public function contact() {
        return view('contact');
    }

    public function dashboard() {
        $products = product::all();
        $categories = category::all();
        $users = User::all();
        return view('dashboard', compact('products','categories','users'));
    }

    public function media() {
        $directory = '/public/media';
        $files = Storage::disk('public')->allFiles();
        return view('media', ['media'=>$files]);
    }
}
