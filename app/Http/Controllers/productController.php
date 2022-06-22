<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\product;
use App\Models\category;
use App\Models\User;
use App\Models\contact;
use App\Models\property;
use App\Models\review;

class productController extends Controller
{
    // ProductDetails van een bepaald product
    public function product($slug) {
        $product = product::where('productSlug', 'like', $slug)->get();
        if (!$product->isEmpty()) {
            $categories = category::all();
            $properties = property::all();
            $products = product::all();
            $reviews = review::all();
            return view('products/product', ['product'=> $product], compact('categories', 'properties', 'products', 'reviews'));
        }
        else {
            return redirect('/store');
        }
    }

    // Als de slug null is dan stuurt hij een redirect naar de webshop
    public function product_redirect() {
        return redirect('/store');
    }

    // Productenlijst in de backend van de site om de producten te veranderen
    public function products() {
        $products = product::all();
        $categories = category::all();
        $users = User::get();
        return view('products/products', compact('products','categories','users'));
    }

    // Toont een pagina met een lege formulierenlijst om een nieuw product toe te voegen
    public function createproduct() {
        $categories = category::all();
        $users = User::all();
        return view('products/create', compact('categories','users'));
    }

    // Zet het formulier van hierboven in de database en stuurt je terug naar de productenlijst is de backend
    public function postproduct(Request $request) {

        $file = $request->file('p_img');
        $fileName = $file->getClientOriginalName();

        $product = new product();
        $product->productName = $request->input('p_name');
        $product->productSlug = $request->input('p_slug');
        $product->productPrice = $request->input('p_price');
        $product->productSalesprice = $request->input('p_saleprice');
        $product->productBrand = $request->input('p_brand');
        $product->productShortDescription = $request->input('p_sd');
        $product->productLongDescription = $request->input('p_ld');
        $product->productImage = $fileName;
        $product->category_ID = $request->input('p_cat');
        $product->createdBy = $request->input('p_cb');
        $product->productStatus = $request->input('p_status');
        $product->productQuantity = $request->input('p_quantity');
        $product->save();

        if (!file_exists(public_path()."media/$fileName")) {
            $destinationPath = public_path().'/media';
            $file->move($destinationPath,$fileName);
        }

        return redirect('/products');
    }

    // Toont een pagina met een gevulde formulierenlijst op basis van de informatie in de database van het product
    public function editproduct(Request $request) {
        $productid = $request->input('id', '');
        if ($productid !== '' && $productid !== null) {
            $product = product::where('productID', 'like', $productid)->get();
            $categories = category::all();
            $property = property::where('productID', 'like', $productid)->get();
            $users = User::all();
            return view('products/edit', ['product'=> $product], compact('categories','users','property'));
        }
        else {
            return redirect('/products');
        }
    }

    // Doet een update van het formulier hierboven en wordt doorgestuurd naar productenlijst in de backend
    public function updateproduct(Request $request) {
        $product = product::where('productID', 'like', $request->input('p_id'))->first();
        $product->productName = $request->input('p_name');
        $product->productSlug = $request->input('p_slug');
        $product->productPrice = $request->input('p_price');
        $product->productSalesprice = $request->input('p_saleprice');
        $product->productBrand = $request->input('p_brand');
        $product->productShortDescription = $request->input('p_sd');
        $product->productLongDescription = $request->input('p_ld');
        if ($request->file('p_img') !== null) {
            $file = $request->file('p_img');
            $fileName = $file->getClientOriginalName();
            $product->productImage = $fileName;
            if (!file_exists(public_path()."media/$fileName")) {
                $destinationPath = public_path().'/media';
                $file->move($destinationPath,$fileName);
            }
        } else {
            $product->productImage = $product->productImage;
        }
        $product->category_ID = $request->input('p_cat');
        $product->createdBy = $request->input('p_mb');
        $product->productStatus = $request->input('p_status');
        $product->productQuantity = $request->input('p_quantity');
        $product->update();

        if (property::where('productID', 'like', $request->input('p_id'))->first() == null) {
            dd('hoi');
            $property = new property();
            $property->productID = $request->input('p_id');
            $property->color = $request->input('pp_color');
            $property->type = $request->input('pp_type');
            $property->material = $request->input('pp_material');
            $property->save();
        }
        else {
            $property = property::where('productID', 'like', $request->input('p_id'))->first();
            // dd($property);
            $property->propertyID = $property->propertyID;
            $property->productID = $property->productID;
            $property->color = $request->input('pp_color');
            $property->type = $request->input('pp_type');
            $property->material = $request->input('pp_material');
            $property->update();
        }


        return redirect('/products');
    }

    // Verwijderd het product uit de database op basis van ID en stuurt je door naar productenlijst in de backend
    public function deleteproduct(Request $id) {
        $productid = $id->input('id', '');
        if ($productid !== '') {
            product::where('productID', $productid)->delete();
        }
        return redirect('/products');
    }

    public function postreview(Request $request) {
        $review = new review();
        $review->productID = $request->input('p_id');
        $review->starRating = $request->input('review_star_rating');
        $review->reviewMessage = $request->input('review_message');
        $review->save();

        return redirect('/product/'.$request->input('p_slug'));
    }
}
