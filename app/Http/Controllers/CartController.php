<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{
    public function addToCart($id)
    {
        $product = Product::findOrFail($id);

        $cart = session()->get('cart', []);

        if(isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                "name" => $product->Name,
                "quantity" => 1,
                "price" => $product->Price,
                "image" => $product->Image_path
            ];
        }

        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Товар додано в кошик!');
    }

    public function cart()
    {
        return view('cart');
    }

    public function removeFromCart($id)
    {
        $cart = session()->get('cart');

        if(isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return redirect()->back()->with('success', 'Товар видалено!');
    }
}