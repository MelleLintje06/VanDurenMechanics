<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\product;
use App\Models\category;
use App\Models\User;
use App\Models\contact;

class categorieController extends Controller
{
    // Categorieënlijst in de backend van de site om de categorieën te veranderen
    public function categories() {
        $products = product::all();
        $categories = category::all();
        $users = User::all();
        return view('categories/categories', compact('products','categories','users'));
    }

    // Toont een pagina met een lege formulierenlijst om een categorie toe te voegen
    public function createcategory() {
        $users = User::all();
        return view('categories/create', compact('users'));
    }

    // Zet de data van het formulier hierboven in de database en stuurt je terug naar de categorieenlijst in de backend
    public function postcategory(Request $request) {
        $cat = new category();
        $cat->categoryName = $request->input('c_name');
        $cat->categorySlug = $request->input('c_slug');
        $cat->createdBy = $request->input('c_mb');
        $cat->categoryImage = $request->input('c_img');
        $cat->categoryStatus = $request->input('c_status');
        $cat->save();
        return redirect('/categories');
    }

    // Toont een pagina met een ingevulde formulierenlijst op basis van ID uit de database
    public function editcategory(Request $request) {
        $cat_id = $request->input('id', '');
        if ($cat_id !== '' && $cat_id !== null) {
            $users = User::all();
            $categories = category::where('categoryID', 'like', $cat_id)->get();
            return view('categories/edit', ['category'=> $categories], ['users'=> $users]);
        }
        else {
            return redirect('/categories');
        }
    }

    // Update de data van bovenstaande formulier en stuurt je door naar categorieenlijst in de backend
    public function updatecategory(Request $update) {
        $cat = category::where('categoryID', 'like', $update->input('c_id'))->first();
        $cat->categoryName = $update->input('c_name');
        $cat->categorySlug = $update->input('c_slug');
        $cat->createdBy = $update->input('c_mb');
        if ($update->input('c_img') !== null) {
            $cat->categoryImage = $update->input('c_img');
        } else {
            $cat->categoryImage = $cat->categoryImage;
        }
        $cat->categoryStatus = $update->input('c_status');
        $cat->update();
        return redirect('/categories');
    }

    // Verwijderd de data uit de database op basis van ID
    public function deletecategory(Request $id) {
        $cat_id = $id->input('id', '');
        if ($cat_id !== '') {
            category::where('categoryID', $cat_id)->delete();
        }
        return redirect('/categories');
    }
}
